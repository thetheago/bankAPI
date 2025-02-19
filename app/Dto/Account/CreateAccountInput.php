<?php

declare(strict_types=1);

namespace App\Dto\Account;

use App\ValueObject\Amount;

class CreateAccountInput extends AbstractCreateAccountInput
{
    public function __construct(Amount $amount, int $accountNumber)
    {
        parent::__construct($amount, $accountNumber);
    }

    public function getAmount(): int
    {
        return $this->amount->floatToMicro();
    }
}
