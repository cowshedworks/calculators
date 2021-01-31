# Calculators

Calculators is a factory for building calculations in a fluent way

**PLEASE NOTE** this is very WIP at the moment, it is really a way to test using packagist to release a PHP package.

## Installation

Use the package manager [composer](https://getcomposer.org/) to install.

```bash
composer require cowshedworks/calculators
```

## Usage

```php
use CowshedWorks\Calculators\Calculation;

$calculator = (new CalculationFactory())
    ->using($first))
    ->multiplyBy(10)
    ->addTo($second)
    ->build();

$calculator(10, 30);
// prints 130
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](LICENCE.md)
