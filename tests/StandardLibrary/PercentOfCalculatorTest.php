<?php

namespace CowshedWorks\Calculators\Tests;

use CowshedWorks\Calculators\CalculatorFactory;
use CowshedWorks\Calculators\StandardLibrary\PercentOfCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PercentOfCalculatorTest extends TestCase
{
    /** @test */
    public function it_describes_itself()
    {
        $calculator = $this->getCalcuator();

        $this->assertEquals('Returns the specified percentage of the input.', $calculator->describe());
    }

    /** @test */
    public function it_returns_the_expected_result()
    {
        $calculator = $this->getCalcuator();

        $this->assertEquals(25, $calculator->calculate(100, 25)->get());
        $this->assertEquals(100, $calculator->calculate(10, 1000)->get());
        $this->assertEquals(0, $calculator->calculate(0, 100)->get());
        $this->assertEquals(20, $calculator->calculate(200, 10)->get());
    }

    /** @test */
    public function it_throws_with_too_many_parameters()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Calculator was expecting 2 but got 3');

        $calculator = $this->getCalcuator();
        $result = $calculator->calculate(12, 23, 242);

        $this->assertEquals(0, $result->get());
    }

    /** @test */
    public function it_throws_with_negative_percentage()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Percentage should be greater than 0');

        $calculator = $this->getCalcuator();
        $result = $calculator->calculate(-10, 100);

        $this->assertEquals(0, $result->get());
    }

    private function getCalcuator(): PercentOfCalculator
    {
        return CalculatorFactory::new()->make('percentOf');
    }
}
