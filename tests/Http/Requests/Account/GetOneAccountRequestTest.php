<?php

namespace Tests\Http\Requests\Account;

use App\Http\Requests\Account\GetOneAccountRequest;
use PHPUnit\Framework\TestCase;

class GetOneAccountRequestTest extends TestCase
{
    public function testMessages()
    {
        $request = new GetOneAccountRequest();
        $this->assertEquals(
            [
                'numero_conta' => 'required|numeric|min:1',
            ],
            $request->rules()
        );
    }

    public function testRules()
    {
        $request = new GetOneAccountRequest();
        $this->assertEquals(
            [
                'numero_conta.required' => 'O número da conta é obrigatório.',
                'numero_conta.numeric' => 'O número da conta deve ser um número.',
                'numero_conta.min' => 'O número da conta deve ser maior que 0',
            ],
            $request->messages()
        );
    }
}
