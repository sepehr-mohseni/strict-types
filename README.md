# PHP Strict Types Adder

[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Latest Version](https://img.shields.io/packagist/v/sepmni/strict-types)](https://packagist.org/packages/sepmni/strict-types)
[![Total Downloads](https://img.shields.io/packagist/dt/sepmni/strict-types)](https://packagist.org/packages/sepmni/strict-types)

The PHP Strict Types Adder is a Composer package that allows you to automatically add `declare(strict_types=1);` to PHP files within a directory recursively. It ensures your PHP files are consistent and have strict type checking enabled without the need for manual editing.

## Features

- Recursively add `declare(strict_types=1);` to PHP files within a specified directory.
- Ignores files that already have a `declare(strict_types=1);` statement.
- Excludes files within the "vendor" folder and those with ".blade.php" in the name.
- Automatically detects and handles existing `<?php` tags.

## Installation

You can install the PHP Strict Types Adder using Composer:

```bash
composer require sepmni/strict-types
```

## Usage

Once installed, you can use the command-line interface (CLI) to add `declare(strict_types=1);` to your PHP files.

```bash
php vendor/sepmni/strict-types/StrictTypes.php add /path/to/your/php/files/directory
```

Replace `/path/to/your/php/files/directory` with the path to the directory you want to process.

## Example

Let's say you have a project directory structure like this:

```
project/
  ├── src/
  │   ├── app.php
  │   ├── other.php
  └── vendor/
      ├── ...
```

To add strict types declarations to all PHP files in the `src/` directory (excluding those with existing declarations), you would run:

```bash
php vendor/sepmni/strict-types/StrictTypes.php add project/src
```

The package will process all PHP files within the specified directory and its subdirectories.

## Contributing

If you'd like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and write tests.
4. Submit a pull request with a clear description of your changes.

## License

This package is open-source software licensed under the [MIT License](LICENSE).

## Support

If you have any questions or encounter issues, please feel free to open a [GitHub issue](https://github.com/sepmni/strict-types/issues). We welcome your feedback and contributions!

## Acknowledgments

Special thanks to the PHP community and the tools that made this package possible.

```
