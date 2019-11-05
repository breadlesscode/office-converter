# Office converter (with LibreOffice)
[![Latest Stable Version](https://poser.pugx.org/breadlesscode/office-converter/v/stable)]()
[![Downloads](https://img.shields.io/packagist/dt/breadlesscode/office-converter.svg)]()
[![License](https://img.shields.io/github/license/breadlesscode/office-converter.svg)]()

This package is for converting office formats to something else. You can generate Thumbnails, PDFs etc..

## Requirements
 - [LibreOffice](https://libreoffice.org/) for the convertion.
 - PHP >= 7.1

## Which extension can be converted to what?
You can check the following files:
- [WriterConverter.php](src/Converters/WriterConverter.php)
- [CalcConverter.php](./src/Converters/CalcConverter.php)
- [DrawConverter.php](src/Converters/DrawConverter.php)
- [ImpressConverter.php](src/Converters/ImpressConverter.php)

## Installation

This package can be installed through Composer.
```bash
composer require breadlesscode/office-converter
```
## How to use

```php
use \Breadlesscode\Office\Converter;

Converter::file('Test.odt') // select a file for convertion
    ->setLibreofficeBinaryPath('/usr/bin/libreoffice') // binary to the libreoffice binary
    ->setTemporaryPath('./temp') // temporary directory for convertion
    ->setTimeout(100) // libreoffice process timeout
    ->save(__DIR__.'/lorem.pdf'); // save as pdf
```

## Examples

### Save with original name in folder
```php
use Breadlesscode\Office\Converter;

Converter::file('./Test.odt')
    ->save('./lorem', 'jpg');
```
### Save with custom name
```php
use Breadlesscode\Office\Converter;

Converter::file('./Test.odt')
    ->save('./lorem.jpg');
```

## Testing

``` bash
$ composer test
```
## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
