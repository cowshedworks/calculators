<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

class PipedCalculator
{
    protected Calculator $calculator;

    protected array $params = [];

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }

    public function runCalculation($input): CalculatorResult
    {
        return $this->calculator->calculate(
            ...$this->mergeParameters($input)
        );
    }

    protected function mergeParameters($input): array
    {
        if ($input instanceof CalculatorResult) {
            $input = $input->get();
        }

        if (is_array($input)) {
            $input = $input[0];
        }

        if (count($this->params) === 0) {
            return [0 => $input];
        }

        $mergedParameters = array_merge($this->calculator->getParameters(), $this->params);

        $finalParameters = [];

        foreach ($mergedParameters as $key => $parameter) {
            $finalParameters[$key] = ($parameter === 'input') ? $input : $parameter;
        }

        return array_values($finalParameters);
    }
}
