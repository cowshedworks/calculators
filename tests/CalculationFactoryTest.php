<?php

namespace CowshedWorks\Calculators\Tests;

use CowshedWorks\Calculators\CalculationFactory;
use PHPUnit\Framework\TestCase;

class CalculationFactoryTest extends TestCase
{
    /** @test */
    public function it_can_build_a_multiplier()
    {
        $calculator = (new CalculationFactory())
            ->using('p1')
            ->multiplyBy(10)
            ->build();

        $this->assertEquals(100, $calculator(10));
    }

    /** @test */
    public function it_can_build_a_more_complicated_multiplier()
    {
        $calculator = (new CalculationFactory())
            ->using('p1')
            ->multiplyBy('p2')
            ->build();

        $this->assertEquals(100, $calculator(10, 10));
    }

    /** @test */
    public function it_can_build_an_even_more_complicated_multiplier()
    {
        $calculator = (new CalculationFactory())
            ->using('p1')
            ->multiplyBy(10)
            ->multiplyBy('p2')
            ->build();

        $this->assertEquals(1000, $calculator(10, 10));
    }
}
