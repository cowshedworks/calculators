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

    private function mapInput(array $inputArgs = []): array
    {
        $totalInputArgs = count($inputArgs);
        $calculatorParameters = $this->getParameters();
        $totalExpectedParameters = count($calculatorParameters);

        if ($totalInputArgs === 0) {
            throw new InvalidArgumentException('Nothing was passed to the calculator');
        }

        if ($totalInputArgs !== $totalExpectedParameters) {
            throw new InvalidArgumentException("Calculator was expecting {$totalExpectedParameters} but got {$totalInputArgs}");
        }

        return array_combine($this->getParameters(), $inputArgs);
    }

    abstract protected function handle(): CalculatorResult;
}
