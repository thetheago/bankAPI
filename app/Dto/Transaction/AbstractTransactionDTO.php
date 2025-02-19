<?php

declare(strict_types=1);

namespace App\Dto\Transaction;

use App\Enum\PaymentMethodEnum;
use App\ValueObject\Amount;

class AbstractTransactionDTO
{
    private(set) PaymentMethodEnum $paymentMethod;

    private int $accountNumber;

    protected Amount $amount;

    public function __construct(PaymentMethodEnum $paymentMethod, int $accountNumber, Amount $amount)
    {
        $this->paymentMethod = $paymentMethod;
        $this->accountNumber = $accountNumber;
        $this->amount = $amount;
    }

    public function getAccountNumebr(): int
    {
        return $this->accountNumber;
    }
}
