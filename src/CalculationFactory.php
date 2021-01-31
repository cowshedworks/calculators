<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

class CalculationFactory
{
    protected array $calculationPipeline;

    public function __construct()
    {
        $this->calculation = new Calculation;
    }

    public function using(string $parameter): self
    {
        $this->calculation->addParameter($parameter);

        return $this;
    }

    public function multiplyBy($number): self
    {
        $this->calculation->addOpcode('TIMES');

        if ($this->calculation->isParameter($number)) {
            $this->calculation->addParameter($number);

            return $this;
        }

        $this->calculation->addOpcode($number);

        return $this;
    }

    public function build(): callable
    {
        return $this->calculation->getCallable();
    }
}
