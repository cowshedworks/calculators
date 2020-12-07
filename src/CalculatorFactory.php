<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

use Exception;

class CalculatorFactory
{
    protected array $standardLibrary = [
        'timesZero' => \CowshedWorks\Calculators\StandardLibrary\TimesZeroCalculator::class,
        'percentOf' => \CowshedWorks\Calculators\StandardLibrary\PercentOfCalculator::class,
    ];

    protected array $calculators = [];

    public function __construct()
    {
        $this->registerStandardLibrary();
    }

    public static function new(): self
    {
        return new self();
    }

    public function register(string $name, string $calculatorClass): void
    {
        if ($this->calculatorIsRegistered($name)) {
            throw new Exception("Calculator {$name} is already registered with the factory");
        }

        $this->calculators[$name] = $calculatorClass;
    }

    public function make(string $name): Calculator
    {
        if ($this->calculatorIsRegistered($name) === false) {
            throw new Exception("Calculator {$name} is not registered with the factory");
        }

        return new $this->calculators[$name](new InputValidator());
    }

    private function registerStandardLibrary(): void
    {
        foreach ($this->standardLibrary as $name => $class) {
            $this->register($name, $class);
        }
    }

    private function calculatorIsRegistered(string $name): bool
    {
        return array_key_exists($name, $this->calculators);
    }
}
