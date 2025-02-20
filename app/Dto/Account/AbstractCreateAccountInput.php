<?php

declare(strict_types=1);

namespace App\Dto\Account;

use App\ValueObject\Amount;

class AbstractCreateAccountInput
{
    protected Amount $amount;

    protected int $accountNumber;

    public function __construct(Amount $amount, int $accountNumber)
    {
        $this->amount        = $amount;
        $this->accountNumber = $accountNumber;
    }

    public function getAccountNumber(): int
    {
        return $this->accountNumber;
    }
}
