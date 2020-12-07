<?php

namespace CowshedWorks\Calculators\Tests;

use CowshedWorks\Calculators\Composition;
use PHPUnit\Framework\TestCase;

class CalculatorCompositionTest extends TestCase
{
    /** @test */
    public function it_can_compose_calculators()
    {
        $composition = (new Composition())
            ->use('multipliedBy')->with(['by' => 100])
            ->use('timesZero')
            ->build();

        $this->assertEquals(0, $composition(10));
    }
}
