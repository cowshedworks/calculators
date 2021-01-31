<?php

declare(strict_types=1);

namespace CowshedWorks\Calculators;

class Calculation
{
    protected $opCodes = [];
    protected $runCodes = [];

    public function addOpCode($opCode): void
    {
        $this->opCodes[] = $opCode;
    }

    public function addParameter($parameter): void
    {
        $this->opCodes[] = strtoupper($parameter);
    }

    public function isParameter($value): bool
    {
        if (false === is_string($value)) {
            return false;
        }

        return substr($value, 0, 1) === 'P' || substr($value, 0, 1) === 'p';
    }

    public function getCallable(): callable
    {
        return function () {
            // assign the parameters that we receive to opcode values
            // and then make the calculation using the opcodes
            $counter = 1;
            $params = [];
            
            foreach (func_get_args() as $index => $parameter) {
                $params['P'.($index + 1)] = $parameter;
            }

            $currentValue = 0;
            $currentToken = null;
            foreach ($this->opCodes as $opCodeIndex => $opLine) {

                // Convert parameters to actual values
                if (is_string($opLine) && $this->isParameter($opLine)) {
                    $opLine = $params[$opLine];
                }

                // Assign current value if first iteration
                if (\is_numeric($opLine)) {
                    if ($opCodeIndex === 0) {
                        $currentValue = $opLine;

                        continue;
                    }
                }

                if ($this->isToken($opLine)) {
                    $currentToken = $opLine;

                    continue;
                }

                $currentValue = $this->calculateWithToken($currentToken, $currentValue, $opLine);
            }

            return $currentValue;
        };
    }

    protected function calculateWithToken($token, $currentValue, $currentOpCode)
    {
        if ($token === 'TIMES') {
            return $currentValue * $currentOpCode;
        }

        return $currentOpCode;
    }

    protected function isToken($value)
    {
        $tokens = ['TIMES', 'PLUS', 'MINUS', 'DIVIDE'];

        return in_array($value, $tokens);
    }
}
