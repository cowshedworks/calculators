<?php

namespace CowshedWorks\Calculators;

class IntegerResult extends CalculatorResult
{
    protected int $result;

    public function __construct(int $result)
    {
        $this->result = $result;
    }

    public function get(): int
    {
        return $this->result;
    }
}
