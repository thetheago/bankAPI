<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Enum\AmountStateEnum;
use BcMath\Number;

class Amount
{
    const int MICRO_BASE = 100000;

    public Number $amount;

    private AmountStateEnum $amountState;

    public function __construct(float|int $amount, AmountStateEnum $amountState)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("Saldo não deve ser negativo");
        }

        $this->amount = new Number((string) $amount);
        $this->amountState = $amountState;
    }

    public function getFloat(): float
    {
        if ($this->amountState === AmountStateEnum::FLOAT) {
            return (float) $this->amount->value;
        }

        return (float) $this->amount->div((string) self::MICRO_BASE)->value;
    }

    public function getMicro(): int
    {
        if ($this->amountState === AmountStateEnum::MICRO) {
            return (int) $this->amount->value;
        }

        return (int) $this->amount->mul((string) self::MICRO_BASE)->value;
    }
}
