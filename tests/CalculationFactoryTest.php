<?php

namespace CowshedWorks\Calculators\Tests;

use CowshedWorks\Calculators\CalculationFactory;
use PHPUnit\Framework\TestCase;

class CalculationFactoryTest extends TestCase
{
    /** @test */
    public function it_can_build_an_adder()
    {
        $calculator = (new CalculationFactory())
            ->using('p1')
            ->add(10)
            ->build();

        $this->assertEquals(20, $calculator(10));
    }

    /** @test */
    public function it_can_build_a_more_complicated_adder()
    {
        $calculator = (new CalculationFactory())
            ->using('p1')
            ->add(10)
            ->add(100)
            ->add(1)
            ->build();

        $this->assertEquals(121, $calculator(10));
    }

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

    /** @test */
    public function it_can_build_a_multiplier_and_adder()
    {
        $calculator = (new CalculationFactory())
            ->using('p1')
            ->multiplyBy('p2')
            ->add(1000)
            ->build();

        $this->assertEquals(1100, $calculator(10, 10));
    }

    /** @test */
    public function it_can_build_a_subtractor()
    {
        $calculator = (new CalculationFactory())
            ->using('p1')
            ->subtract(10)
            ->build();

        $this->assertEquals(10, $calculator(20));
    }

    /** @test */
    public function it_can_build_a_divider()
    {
        $calculator = (new CalculationFactory())
            ->using('p1')
            ->divideBy(2)
            ->build();

        $this->assertEquals(5, $calculator(10));
    }

    /** @test */
    public function it_can_build_a_more_complicated_subtractor()
    {
        $calculator = (new CalculationFactory())
            ->using('p1')
            ->subtract(10)
            ->subtract(100)
            ->build();

        $this->assertEquals(890, $calculator(1000));
    }

    /** @test */
    public function it_can_build_a_multiplier_and_adder_and_subtractor()
    {
        $calculator = (new CalculationFactory())
            ->using('p1')
            ->multiplyBy('p2')
            ->add(1000)
            ->subtract(500)
            ->build();

        $this->assertEquals(600, $calculator(10, 10));
    }

    /** @test */
    public function it_can_build_a_circumference_calculator()
    {
        $circumferenceFromDiameter = (new CalculationFactory())
            ->using('p1')
            ->multiplyBy(pi())
            ->build();

        $this->assertEquals(31.41592653589793, $circumferenceFromDiameter(10));
    }

    /** @test */
    public function it_can_build_a_nested_calculations()
    {
        $radiusFromCircumference = (new CalculationFactory())
            ->using('p1')
            ->divideBy(
                (new CalculationFactory())
                    ->using(pi())
                    ->multiplyBy(2)
            )
            ->build();

        $this->assertEquals(1.5915494309189497, $radiusFromCircumference(10));
    }
}
