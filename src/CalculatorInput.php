<?php

namespace CowshedWorks\Calculators;

use InvalidArgumentException;

class CalculatorInput
{
    protected array $input;

    public function __construct(array $parameters)
    {
        $this->input = $parameters;
    }

    public function get($inputKey)
    {
        if (array_key_exists($inputKey, $this->input) === false) {
            throw new InvalidArgumentException("{$inputKey} not found in input parameters");
        }
            
        return $this->input[$inputKey];
    }
}