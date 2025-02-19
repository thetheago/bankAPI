<?php

declare(strict_types=1);

namespace App\Dto\Account;

use App\ValueObject\Amount;

class AbstractCreateAccountInput
{
    protected Amount $amount;

    protected int $accountNumber {
        get {
            return $this->accountNumber;
        }
    }

    public function __construct(Amount $amount, int $accountNumber)
    {
        $this->amount        = $amount;
        $this->accountNumber = $accountNumber;
    }

    public function getAmount(): int
    {
        return $this->amount->floatToMicro();
    }

}
