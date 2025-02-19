<?php

declare(strict_types=1);

namespace App\Factory\Account;

use App\Dto\Account\CreateAccountInput;
use App\ValueObject\Amount;
use Illuminate\Http\Request;

class CreateAccountInputFactory
{
    public static function createFromRequest(Request $request): CreateAccountInput
    {
        // Deixando a validação com o laravel, mas aqui seria uma boa parte para validar

        $amount        = $request->input("saldo");
        $accountNumber = $request->input("numero_conta");

        return new CreateAccountInput(new Amount($amount), $accountNumber);
    }
}
