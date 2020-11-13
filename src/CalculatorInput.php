<?php

namespace CowshedWorks\Calculators;

class CalculatorInput
{
    protected array $input;

    public function __construct()
    {
        $args = func_get_args();
        $this->input = $args[0];
    }

    public function get($inputKey)
    {
        return $this->input[$inputKey];
    }
}