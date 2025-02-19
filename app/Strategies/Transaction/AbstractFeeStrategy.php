<?php

namespace App\Strategies\Transaction;

use App\Interface\Transaction\ITransactionStrategy;

class AbstractFeeStrategy implements ITransactionStrategy
{
    protected float $fee = 1;

    public function addFeeAndReturnNewAmount(int $amount): int
    {
        return (int) ($amount * $this->fee);
    }
}
