<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators\StandardLibrary;

use CowshedWorks\Calculators\Calculator;
use CowshedWorks\Calculators\CalculatorResult;
use CowshedWorks\Calculators\FloatResult;

class MultipliedByCalculator extends Calculator
{
    public function getParameters(): array
    {
        return [
            'number' => 'numeric',
            'by' => 'numeric',
        ];
    }

    public function describe(): string
    {
        return 'Returns the input number multiplied by the second parameter.';
    }

    public function handle(): CalculatorResult
    {
        return new FloatResult(
            $this->input->get('number') * $this->input->get('by')
        );
    }
}
