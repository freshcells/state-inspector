# state-inspector

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-ghactions]][link-ghactions]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Use Case:**  
Inspect if a state tree, a nested object or any object has certain states or values.


An Inspector can take n Inspections and an Inspection can produce several Issues.
The Inspector iterates Inspections which inspect the given object.  

When the *bubble* option is true it will throw an exception immediatly if one occurs.
If *bubble* is false it will collect issues and they can be retrieved after Inspector has finished.


## Install

Via Composer

``` bash
$ composer require freshcells/state-inspector
```

## Usage

        $inspector = new StateInspector();
        $inspector->addInspection(new FooInspection());
        $issues = $inspector->inspect($object);

See tests.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email ivo.bathke@gmail.com instead of using the issue tracker.

## Credits

- [Ivo Bathke][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/freshcells/state-inspector.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-ghactions]: https://github.com/freshcells/state-inspector/actions/workflows/main.yml/badge.svg
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/freshcells/state-inspector.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/freshcells/state-inspector.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/freshcells/state-inspector.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/freshcells/state-inspector
[link-ghactions]: https://github.com/freshcells/state-inspector/actions
[link-scrutinizer]: https://scrutinizer-ci.com/g/freshcells/state-inspector/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/freshcells/state-inspector
[link-downloads]: https://packagist.org/packages/freshcells/state-inspector
[link-author]: https://github.com/freshcells
[link-contributors]: ../../contributors
