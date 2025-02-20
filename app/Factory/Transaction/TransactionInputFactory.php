<?php

declare(strict_types=1);

namespace App\Factory\Transaction;

use App\Dto\Transaction\TransactionInput;
use App\Enum\AmountStateEnum;
use App\Enum\PaymentMethodEnum;
use App\Interface\IInputDTOFactory;
use App\ValueObject\Amount;
use Illuminate\Http\Request;

class TransactionInputFactory implements IInputDTOFactory
{
    public static function createFromRequest(Request $request): TransactionInput
    {
        $paymentMethod = $request->input('forma_pagamento');
        $accountNumber = $request->input('numero_conta');
        $amount = $request->input('valor');

        return new TransactionInput(
            paymentMethod: PaymentMethodEnum::from($paymentMethod),
            accountNumber: $accountNumber,
            amount: new Amount($amount, AmountStateEnum::FLOAT)
        );
    }
}
