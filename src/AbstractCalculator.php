<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

use InvalidArgumentException;

abstract class AbstractCalculator
{
    protected CalculatorInput $input;

    abstract public function describe(): string;

    abstract protected function getParameters(): array;

    public function calculate(): CalculatorResult
    {
        $this->input = new CalculatorInput(
            $this->mapInput(func_get_args())
        );

        return $this->handle();
    }

    private function mapInput(array $inputParameters = []): array
    {
        $totalInputParameters = count($inputParameters);
        $calculatorParameters = $this->getParameters();
        $totalExpectedParameters = count($calculatorParameters);

        if ($totalInputParameters === 0) {
            throw new InvalidArgumentException('Nothing was passed to the calculator');
        }

        if ($totalInputParameters !== $totalExpectedParameters) {
            throw new InvalidArgumentException("Calculator was expecting {$totalExpectedParameters} but got {$totalInputParameters}");
        }

        return array_combine($this->getParameters(), $inputParameters);
    }

    abstract protected function handle(): CalculatorResult;
}
