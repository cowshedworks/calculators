<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

class FloatResult extends CalculatorResult
{
    protected float $result;

    public function __construct(float $result)
    {
        $this->result = $result;
    }

    public function get(): int
    {
        return $this->result;
    }
}
