<?php
declare(strict_types=1);

namespace CowshedWorks\Calculators;

use CowshedWorks\Calculators\Calculator;
use Exception;

class CalculatorFactory
{
    protected array $standardLibrary = [
        'timesZero' => \CowshedWorks\Calculators\StandardLibrary\TimesZeroCalculator::class,
    ];

    protected array $calculators = [];

    public function __construct()
    {
        $this->registerStandardLibrary();
    }
    
    public static function make(): self
    {
        return new self;
    }

    public function register(string $name, string $calculatorClass): void
    {
        if ($this->calculatorIsRegistered($name)) {
            throw new Exception("Calculator {$name} is already registered with the factory");
        }

        $this->calculators[$name] = $calculatorClass;
    }

    public function get(string $name): AbstractCalculator
    {
        if ($this->calculatorIsRegistered($name) === false) {
            throw new Exception("Calculator {$name} is not registered with the factory");
        }

        return new $this->calculators[$name];
    }

    private function registerStandardLibrary(): void
    {
        foreach($this->standardLibrary as $name => $class) {
            $this->register($name, $class);
        }
    }

    private function calculatorIsRegistered(string $name): bool
    {
        return array_key_exists($name, $this->calculators);
    }
}
