# Office converter (with LibreOffice)
[![Latest Stable Version](https://poser.pugx.org/breadlesscode/office-converter/v/stable)]()
[![Downloads](https://img.shields.io/packagist/dt/breadlesscode/office-converter.svg)]()
[![License](https://img.shields.io/github/license/breadlesscode/office-converter.svg)]()

This package is for converting office formats to something else. You can generate Thumbnails, PDFs etc.. 

## Requirements
This package needs [LibreOffice](https://libreoffice.org/) for the convertion.

## Which extension can be converted to what?
You can check the following files:
- [WriterProgramm.php](src/Programs/WriterProgram.php)
- [CalcProgramm.php](./src/Programs/CalcProgram.php)
- [DrawProgramm.php](src/Programs/DrawProgram.php)
- [ImpressProgramm.php](src/Programs/ImpressProgram.php)

## Installation

This package can be installed through Composer.
```bash
composer require breadlesscode/office-conveter
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
## ToDo
- [ ] Rethinking parameter building process
- [ ] Add some more Tests

Ideas and PRs are welcome :)
## Testing

``` bash
$ composer test
```
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
