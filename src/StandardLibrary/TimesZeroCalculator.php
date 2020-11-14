<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators\StandardLibrary;

use CowshedWorks\Calculators\Calculator;
use CowshedWorks\Calculators\CalculatorResult;
use CowshedWorks\Calculators\IntegerResult;

class TimesZeroCalculator extends Calculator
{
    public function getParameters(): array
    {
        return [
            'toMultiply' => 'numeric',
        ];
    }

    public function describe(): string
    {
        return 'Returns the input multiplied by zero, useful.';
    }

    public function handle(): CalculatorResult
    {
        return new IntegerResult(
            $this->input->get('toMultiply') * 0
        );
    }
}
