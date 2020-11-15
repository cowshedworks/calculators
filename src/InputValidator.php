<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

use InvalidArgumentException;

class InputValidator
{
    public function validate(array $calculatorParameters, array $inputParameters): void
    {
        foreach (array_combine($calculatorParameters, $inputParameters) as $validateMethod => $inputValue) {
            $this->{$validateMethod}($inputValue);
        }
    }

    private function numeric($value): void
    {
        if (is_numeric($value)) {
            return;
        }

        throw new InvalidArgumentException('Parameter was incorrect type, expecting numeric recieved '.gettype($value));
    }
}
