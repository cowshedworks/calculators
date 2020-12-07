# Calculators

Calculators is a factory of calculators for non-trivial calculations. It's purpose is to remove the need to implement and test algorithms otherwise not implemented in the PHP standard library.

**PLEASE NOTE** this is very WIP at the moment, calculators will start being added asap in a range of categories including finance, scienfific and language.

## Installation

Use the package manager [composer](https://getcomposer.org/) to install.

```bash
composer require cowshedworks/calculators
```

## Usage

```php
use CowshedWorks\Calculators\CalculatorFactory;

$factory = CalculatorFactory::new();
$calculator = $factory->make('timesZero');
$result = $calculator->calculate(400);

echo $result->get();
//prints 0
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](LICENCE.md)
