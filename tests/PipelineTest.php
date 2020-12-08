<?php

namespace CowshedWorks\Calculators\Tests;

use CowshedWorks\Calculators\Pipeline;
use PHPUnit\Framework\TestCase;

class PipelineTest extends TestCase
{
    /** @test */
    public function it_can_compose_calculators()
    {
        $composition = (new Pipeline())
            ->multipliedBy(['number' => 'input', 'by' => 100])
            ->timesZero()
            ->build();

        $this->assertEquals(0, $composition(10));
    }

    /** @test */
    public function it_can_compose_calculations()
    {
        $calculation = (new Pipeline())
            ->multipliedBy(['number' => 'input', 'by' => 100])
            ->percentOf(['percentage' => 10, 'of' => 'input'])
            ->build();

        $this->assertEquals(100, $calculation(10));
    }
}
