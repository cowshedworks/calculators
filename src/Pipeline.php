<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

class Pipeline
{
    protected CalculatorFactory $factory;

    protected array $pipeline;

    public function __construct()
    {
        $this->factory = new CalculatorFactory;
    }

    protected function use(string $calculator): self
    {
        $this->pipeline[] = new PipedCalculator(
            $this->factory->make($calculator)
        );

        return $this;
    }

    protected function with(array $with): self
    {
        $this->pipeline[count($this->pipeline) - 1]->setParams($with);

        return $this;
    }

    public function build(): callable
    {
        // This needs to loop over each calculator
        // resolve the provided parameters and merge them with the chained value

        return function () {
            $carry = func_get_args();

            foreach ($this->pipeline as $pipedCalculator) {
                $carry = $pipedCalculator->runCalculation($carry);
            }

            return $carry->get();
        };
    }

    public function __call($method, $params)
    {
        $this->use($method);
        $this->with((count($params) > 0) ? $params[0] : []);

        return $this;
    }
}
