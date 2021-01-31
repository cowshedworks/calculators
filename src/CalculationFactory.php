<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

class CalculationFactory
{
    public function __construct()
    {
        $this->calculation = new Calculation;
    }

    public function using(string $parameter): self
    {
        $this->calculation->addParameter($parameter);

        return $this;
    }

    public function subtract($number): self
    {
        $this->calculation->addOpcode('SUBTRACT');

        $this->addOpcode($number);

        return $this;
    }

    public function add($number): self
    {
        $this->calculation->addOpcode('ADD');

        $this->addOpcode($number);

        return $this;
    }

    public function multiplyBy($number): self
    {
        $this->calculation->addOpcode('TIMES');

        $this->addOpcode($number);

        return $this;
    }

    public function divideBy($number): self
    {
        $this->calculation->addOpcode('DIVIDE');

        $this->addOpcode($number);

        return $this;
    }

    protected function addOpcode($number): void
    {
        if ($this->calculation->isParameter($number)) {
            $this->calculation->addParameter($number);

            return;
        }

        if ($this->calculation->isFactory($number)) {
            $this->calculation->addFactory($number);

            return;
        }

        $this->calculation->addOpcode($number);
    }

    public function build(): callable
    {
        return $this->calculation->getCallable();
    }
}
