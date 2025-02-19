<?php

declare(strict_types=1);

namespace App\Strategies\Transaction;

class CreditStrategy extends AbstractFeeStrategy
{
    public function __construct()
    {
        $this->fee = 1.05;
    }
}
