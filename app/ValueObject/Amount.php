<?php

declare(strict_types=1);

namespace App\ValueObject;

use BcMath\Number;

class Amount
{
    const int MICRO_BASE = 100000;

    public Number $amount;

    public function __construct(float|int $amount)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("Saldo não deve ser negativo");
        }

        $this->amount = new Number((string) $amount);
    }

    public function microToFloat(): float
    {
        return (float) $this->amount->div((string) self::MICRO_BASE);
    }

    public function floatToMicro(): int
    {
        return (int) $this->amount->mul((string) self::MICRO_BASE);
    }
}
