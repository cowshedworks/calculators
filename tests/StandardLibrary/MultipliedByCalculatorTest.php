<?php

namespace CowshedWorks\Calculators\Tests;

use CowshedWorks\Calculators\CalculatorFactory;
use CowshedWorks\Calculators\StandardLibrary\MultipliedByCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class MultipliedByCalculatorTest extends TestCase
{
    /** @test */
    public function it_describes_itself()
    {
        $calculator = $this->getCalcuator();

        $this->assertEquals('Returns the input number multiplied by the second parameter.', $calculator->describe());
    }

    /** @test */
    public function it_returns_the_expected_result()
    {
        $calculator = $this->getCalcuator();

        $this->assertEquals(100, $calculator->calculate(10, 10)->get());
        $this->assertEquals(10000, $calculator->calculate(10, 1000)->get());
        $this->assertEquals(0, $calculator->calculate(0, 100)->get());
        $this->assertEquals(2000, $calculator->calculate(200, 10)->get());

        $this->assertEquals(-1000, $calculator->calculate(-100, 10)->get());
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

    private function getCalcuator(): MultipliedByCalculator
    {
        return CalculatorFactory::new()->make('multipliedBy');
    }
}
