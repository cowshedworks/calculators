<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators\StandardLibrary;

use CowshedWorks\Calculators\Calculator;
use CowshedWorks\Calculators\CalculatorResult;
use CowshedWorks\Calculators\FloatResult;

class PercentOfCalculator extends Calculator
{
    public function getParameters(): array
    {
        return [
            'percentage' => 'numeric',
            'of' => 'numeric',
        ];
    }

    public function describe(): string
    {
        return 'Returns the specified percentage of the input.';
    }

    public function handle(): CalculatorResult
    {
        if ($this->input->get('percentage') < 0) {
            $this->throwInvalidArgument('Percentage should be greater than 0');
        }

        return new FloatResult(
            ($this->input->get('percentage') / 100) * $this->input->get('of')
        );
    }
}
