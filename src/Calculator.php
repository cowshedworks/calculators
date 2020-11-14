<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

use InvalidArgumentException;

abstract class Calculator
{
    protected CalculatorInput $input;

    protected InputValidator $validator;

    abstract public function describe(): string;

    abstract protected function getParameters(): array;

    abstract protected function handle(): CalculatorResult;

    public function __construct(InputValidator $validator)
    {
        $this->validator = $validator;
    }

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

        $this->validator->validate(
            array_combine($this->getParameters(), $inputParameters)
        );

        return array_combine(array_keys($this->getParameters()), $inputParameters);
    }
}
