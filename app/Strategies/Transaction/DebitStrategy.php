<?php

declare(strict_types=1);

namespace App\Strategies\Transaction;

class DebitStrategy extends AbstractFeeStrategy
{
    public function __construct()
    {
        $this->fee = 1.03;
    }
}
