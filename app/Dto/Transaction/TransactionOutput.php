<?php

declare(strict_types=1);

namespace App\Dto\Transaction;

use App\Enum\PaymentMethodEnum;
use App\ValueObject\Amount;

class TransactionOutput extends AbstractTransactionDTO
{
    public function __construct(
        int $accountNumber,
        Amount $amount,
        ?PaymentMethodEnum $paymentMethod = PaymentMethodEnum::CREDIT
    ) {
        parent::__construct($paymentMethod, $accountNumber, $amount);
    }

    public function getAmount(): float
    {
        return $this->amount->getFloat();
    }
}
