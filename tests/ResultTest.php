<?php

namespace CowshedWorks\Calculators\Tests;

use CowshedWorks\Calculators\FloatResult;
use CowshedWorks\Calculators\IntegerResult;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    /** @test */
    public function float_result_returns_float()
    {
        $result = new FloatResult(0);

        $this->assertIsFloat($result->get());
    }

    /** @test */
    public function int_result_returns_int()
    {
        $result = new IntegerResult(0);

        $this->assertIsInt($result->get());
    }
}
