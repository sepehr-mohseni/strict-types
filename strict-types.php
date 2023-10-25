<?php

require __DIR__ . '/vendor/autoload.php';

use SepMni\StrictTypes\StrictTypes;

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
