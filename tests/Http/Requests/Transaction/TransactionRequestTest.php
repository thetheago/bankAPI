<?php

namespace Tests\Http\Requests\Transaction;

use App\Http\Requests\Transaction\TransactionRequest;
use PHPUnit\Framework\TestCase;

class TransactionRequestTest extends TestCase
{

    public function testMessages()
    {
        $request = new TransactionRequest();
        $this->assertEquals(
            [
                'forma_pagamento' => ['required', 'string', 'in:P,C,D'],
                'numero_conta' =>  ['required', 'numeric', 'min:1'],
                'valor' => ['required', 'numeric', 'min:0,1', 'decimal:0,4']
            ],
            $request->rules()
        );
    }

    public function testRules()
    {
        $request = new TransactionRequest();
        $this->assertEquals(
            [
                'forma_pagamento.required' => 'A forma de pagamento é obrigatória.',
                'forma_pagamento.string' => 'A forma de pagamento deve ser um enum (D, P ou C).',
                'forma_pagamento.in' => 'A forma de pagamento deve ser um enum (D, P ou C).',
                'numero_conta.required' => 'O número da conta é obrigatório.',
                'numero_conta.numeric' => 'O número da conta deve ser um número.',
                'numero_conta.min' => 'O número da conta deve ser maior que 0.',
                'valor.required' => 'O valor é obrigatório.',
                'valor.numeric' => 'O valor deve ser um número.',
                'valor.min' => 'O valor mínimo par a transação é de 0.1 centavos.',
                'valor.decimal' => 'O valor deve conter no máximo 4 digitos de centavos.'
            ],
            $request->messages()
        );
    }
}
