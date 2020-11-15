<?php

namespace CowshedWorks\Calculators\Tests;

use CowshedWorks\Calculators\CalculatorInput;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CalculatorInputTest extends TestCase
{
    /** @test */
    public function it_stores_and_retrieves_input_parameters()
    {
        $input = new CalculatorInput(['test' => 'value']);

        $this->assertEquals('value', $input->get('test'));
    }

    /** @test */
    public function it_throws_when_no_parameter_found()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('test not found in input parameters');

        $input = new CalculatorInput([]);

        $input->get('test');
    }
}
