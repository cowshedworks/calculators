# Calculators

Calculators is a factory of calculators. It's purpose is to provide common calculations so you don't have to write them in your code. The aim is to be able to compose calculators into an algorithm using a pipeline.

**PLEASE NOTE** this is very WIP at the moment, calculators will start being added asap in a range of categories including finance, scientific and language.

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

use CowshedWorks\Calculators\Pipeline;

$calculation = (new Pipeline())
    ->multipliedBy(['number' => 'input', 'by' => 100])
    ->percentOf(['percentage' => 10, 'of' => 'input'])
    ->build();

echo $calculation(10);
//prints 100
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](LICENCE.md)
