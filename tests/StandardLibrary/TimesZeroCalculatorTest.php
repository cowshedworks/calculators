<?php

namespace CowshedWorks\Calculators\Tests;

use CowshedWorks\Calculators\StandardLibrary\TimesZeroCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TimesZeroCalculatorTest extends TestCase
{
    /** @test */
    public function it_describes_itself()
    {
        $calculator = new TimesZeroCalculator();

        $this->assertEquals('Returns the input multiplied by zero, useful.', $calculator->describe());
    }

    /** @test */
    public function it_returns_the_expected_result()
    {
        $calculator = new TimesZeroCalculator();

        $result = $calculator->calculate(34);

        $this->assertEquals(0, $result->get());
    }

    /** @test */
    public function it_throws_with_no_parameters()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Nothing was passed to the calculator');

        $calculator = new TimesZeroCalculator();

        $result = $calculator->calculate();

        $this->assertEquals(0, $result->get());
    }

    /** @test */
    public function it_throws_with_too_many_parameters()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Calculator was expecting 1 but got 3');
        
        $calculator = new TimesZeroCalculator();

        $result = $calculator->calculate(12, 23, 242);

        $this->assertEquals(0, $result->get());
    }
}
