<?php
declare(strict_types=1);

namespace CowshedWorks\Calculators\StandardLibrary;

use CowshedWorks\Calculators\CalculatorInput;
use CowshedWorks\Calculators\CalculatorResult;
use CowshedWorks\Calculators\IntegerResult;
use CowshedWorks\Calculators\AbstractCalculator;

class TimesZeroCalculator extends AbstractCalculator
{
    public function getParameters(): array
    {
        return [
            'toMultiply',
        ];
    }

    public function describe(): string
    {
        return "Returns the input multiplied by zero, useful.";
    }

    public function handle(): CalculatorResult
    {
        return new IntegerResult(
            $this->input->get('toMultiply') * 0
        );
    }
}
