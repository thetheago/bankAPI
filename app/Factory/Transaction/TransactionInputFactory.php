<?php

declare(strict_types=1);

namespace App\Factory\Transaction;

use App\Dto\Transaction\TransactionInput;
use App\Interface\IInputDTOFactory;
use Illuminate\Http\Request;

class TransactionInputFactory implements IInputDTOFactory
{
    public static function createFromRequest(Request $request): TransactionInput
    {
        $paymentMethod = $request->get('forma_pagamento');
        $accountNumber = $request->get('numero_conta');
        $amount = $request->get('valor');

        return new TransactionInput(
            paymentMethod: $paymentMethod,
            accountNumber: $accountNumber,
            amount: $amount
        );
    }
}
