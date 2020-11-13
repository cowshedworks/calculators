# Calculators

Calculators is a simple calculators factory

**PLEASE NOTE** this is very WIP at the moment, calculators will start being added asap

## Installation

Use the package manager [composer](https://getcomposer.org/) to install.

```bash
composer require cowshedworks/calculators
```

## Usage

```php
use CowshedWorks\Calculators\CalculatorFactory;

$factory = new CalculatorFactory();
$calculator = $factory->get('timesZero');
$result = $calculator->calculate(400);

echo $result->get();
//prints 0
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](LICENCE.md)
