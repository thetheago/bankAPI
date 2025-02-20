<?php

namespace Tests\Http\Requests\Account;

use App\Http\Requests\Account\CreateAccountRequest;
use PHPUnit\Framework\TestCase;

class CreateAccountRequestTest extends TestCase
{

    public function testMessages()
    {
        $request = new CreateAccountRequest();
        $this->assertEquals(
            [
                'numero_conta' => ['required', 'numeric', 'min:1'],
                'saldo' => ['required', 'numeric', 'min:0', 'decimal:0,4']
            ],
            $request->rules()
        );
    }

    public function testRules()
    {
        $request = new CreateAccountRequest();
        $this->assertEquals(
            [
                'numero_conta.required' => 'O número da conta é obrigatório.',
                'numero_conta.numeric' => 'O número da conta deve ser um número.',
                'numero_conta.min' => 'O número da conta deve ser maior que 0',
                'saldo.required' => 'O saldo é obrigatório.',
                'saldo.numeric' => 'O saldo deve ser um número.',
                'saldo.min' => 'O saldo deve ser um número maior que 0.',
                'saldo.decimal' => 'O saldo deve conter no máximo 4 digitos de centavos.'
            ],
            $request->messages()
        );
    }
}
