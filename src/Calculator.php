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
        $inputParameters = func_get_args();

        $calculatorParameters = $this->getParameters();

        $mappedParameters = $this->mapInput($calculatorParameters, $inputParameters);

        $this->validator->validate($calculatorParameters, $inputParameters);

        $this->input = new CalculatorInput($mappedParameters);

        return $this->handle();
    }

    private function mapInput(array $calculatorParameters, array $inputParameters = []): array
    {
        $totalInputParameters = count($inputParameters);
        $totalCalculatorParameters = count($calculatorParameters);

        if ($totalInputParameters === 0) {
            throw new InvalidArgumentException('Nothing was passed to the calculator');
        }

        if ($totalInputParameters !== $totalCalculatorParameters) {
            throw new InvalidArgumentException("Calculator was expecting {$totalCalculatorParameters} but got {$totalInputParameters}");
        }

        return array_combine(
            array_keys($calculatorParameters),
            $inputParameters
        );
    }

    protected function throwInvalidArgument($message)
    {
        throw new InvalidArgumentException($message);
    }
}
