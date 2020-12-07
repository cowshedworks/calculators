<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

class Composition
{
    protected CalculatorFactory $factory;

    protected array $composition;

    public function __construct()
    {
        $this->factory = new CalculatorFactory;
    }

    public function use(string $calculator): self
    {
        $this->composition[] = [
            'calculator' => $this->factory->make($calculator),
            'params' => [],
        ];

        return $this;
    }

    public function with(array $with): self
    {
        $this->composition[count($this->composition) - 1]['params'] = $with;

        return $this;
    }

    public function build(): callable
    {
        return function () {
            $result = $this->composition[0]['calculator']->calculate(
                ...array_values(array_merge(func_get_args(), $this->composition[0]['params']))
            );

            $result = $this->composition[1]['calculator']->calculate(
                $result->get()
            );

            return $result->get();
        };
    }
}
