<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

class IntegerResult extends CalculatorResult
{
    protected int $result;

    public function __construct($result)
    {
        $this->result = (int) $result;
    }

    public function get(): int
    {
        return $this->result;
    }
}
