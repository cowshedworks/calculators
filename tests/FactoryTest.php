<?php

namespace CowshedWorks\Calculators\Tests;

use CowshedWorks\Calculators\Calculator;
use CowshedWorks\Calculators\CalculatorFactory;
use CowshedWorks\Calculators\StandardLibrary\TimesZeroCalculator;
use Exception;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    /** @test */
    public function it_returns_the_expected_calculator()
    {
        $factory = CalculatorFactory::new();
        $calculator = $factory->make('timesZero');

        $this->assertInstanceOf(Calculator::class, $calculator);
        $this->assertInstanceOf(TimesZeroCalculator::class, $calculator);
    }

    /** @test */
    public function it_throws_when_trying_to_register_existing_calculators()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Calculator timesZero is already registered with the factory');

        $factory = CalculatorFactory::new();
        $factory->register('timesZero', TimesZeroCalculator::class);
    }

    /** @test */
    public function it_throws_when_trying_to_get_non_existent_calculators()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Calculator nonExistentCalculator is not registered with the factory');

        $factory = CalculatorFactory::new();
        $factory->make('nonExistentCalculator');
    }
}
