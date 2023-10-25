<?php
declare(strict_types=1);
require __DIR__ . '/../../autoload.php';

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class StrictTypes
{
    public function addStrictTypes(string $filePath)
    {
        $content = file_get_contents($filePath);

        if (strpos($content, 'declare(strict_types=1);') === false) {
            $content = $this->addDeclareStrictTypes($content);
            file_put_contents($filePath, $content);
        }
    }

    private function addDeclareStrictTypes(string $content)
    {
        // If the file doesn't start with <?php, add it along with declare(strict_types=1);
        if (strpos($content, '<?php') !== 0) {
            $content = "<?php\ndeclare(strict_types=1);\n" . $content;
        } else {
            // If <?php is already present, add declare(strict_types=1); after it
            $content = preg_replace('/<\?php/', '<?php' . PHP_EOL . 'declare(strict_types=1);', $content, 1);
        }

        return $content;
    }

    public function processDirectory(string $directory)
    {
        $iterator = new \RecursiveDirectoryIterator($directory);
        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);
        
        foreach ($files as $file) {
            if ($this->shouldProcessFile($file)) {
                $filePath = $file->getPathname();
                if (!$this->hasStrictTypesDeclaration($filePath)) {
                    $this->addStrictTypes($filePath);
                }
            }
        }
    }

    private function shouldProcessFile(\SplFileInfo $file)
    {
        $filePath = $file->getPathname();
        $filename = $file->getFilename();
        return $file->isFile() &&
               pathinfo($filename, PATHINFO_EXTENSION) == 'php' &&
               strpos($filePath, 'vendor') === false &&
               strpos($filename, '.blade.php') === false;
    }

    private function hasStrictTypesDeclaration(string $filePath)
    {
        $content = file_get_contents($filePath);
        return strpos($content, 'declare(strict_types=1);') !== false;
    }
}

if(count($argv) < 3) {
    echo "Provide all the information to run";
    exit(1);
}
$directory = isset($argv[2]) ? $argv[2] : '.';
if ($directory === '.') {
    $directory = getcwd();
}

if (!is_dir($directory)) {
    echo "Error: The provided directory does not exist.\n";
    exit(1);
}

$strictTypes = new StrictTypes();
$strictTypes->processDirectory($directory);

echo "Added declare(strict_types=1); to PHP files.\n";
