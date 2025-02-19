<?php

namespace App\Factory\Transaction;

use App\Enum\PaymentMethodEnum;
use App\Interface\Transaction\ITransactionStrategy;
use App\Strategies\Transaction\CreditStrategy;
use App\Strategies\Transaction\DebitStrategy;
use App\Strategies\Transaction\PixStrategy;

class TransactionStrategyFactory
{
    public static function make(PaymentMethodEnum $method): ITransactionStrategy
    {
        return match ($method) {
            PaymentMethodEnum::PIX    => new PixStrategy(),
            PaymentMethodEnum::CREDIT => new CreditStrategy(),
            PaymentMethodEnum::DEBIT  => new DebitStrategy(),
        };
    }
}
