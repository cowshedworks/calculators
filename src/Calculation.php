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
            $counter = 1;
            $params = [];
            foreach (func_get_args() as $index => $parameter) {
                $params['P'.($index + 1)] = $parameter;
            }
            // in here we need to assign the parameters that we receive
            // and then execure the opCodes using the supplied parameters
            foreach ($this->opCodes as $opLine) {
                if (is_string($opLine) && $this->isParameter($opLine)) {
                    $this->runCodes[] = $params[$opLine];

                    continue;
                }

                if (is_string($opLine) && $opLine === 'TIMES') {
                    $this->runCodes[] = '*';

                    continue;
                }

                $this->runCodes[] = $opLine;
            }

            $currentValue = 0;
            $currentToken = null;
            foreach ($this->runCodes as $runIndex => $currentOpCode) {
                if (\is_numeric($currentOpCode)) {
                    if ($runIndex === 0) {
                        $currentValue = $currentOpCode;
                        continue;
                    }
                }

                if ($this->isToken($currentOpCode)) {
                    $currentToken = $currentOpCode;

                    continue;
                }

                $currentValue = $this->calculateWithToken($currentToken, $currentValue, $currentOpCode);
            }

            return $currentValue;
        };
    }

    protected function calculateWithToken($token, $currentValue, $currentOpCode)
    {
        if ($token === '*') {
            return $currentValue * $currentOpCode;
        }

        return $currentOpCode;
    }

    protected function isToken($value)
    {
        $tokens = ['*', '+', '-', '/'];

        return in_array($value, $tokens);
    }
}
