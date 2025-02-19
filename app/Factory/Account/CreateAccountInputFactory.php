<?php

declare(strict_types=1);

namespace App\Factory\Account;

use Illuminate\Http\Request;

use App\Dto\Account\CreateAccountInput;
use App\Interface\IInputDTOFactory;
use App\ValueObject\Amount;

class CreateAccountInputFactory implements IInputDTOFactory
{
    public static function createFromRequest(Request $request): CreateAccountInput
    {
        // Deixando a validação com o laravel, mas aqui seria uma boa parte para validar

        $amount        = $request->input("saldo");
        $accountNumber = $request->input("numero_conta");

        return new CreateAccountInput(new Amount($amount), $accountNumber);
    }
}
