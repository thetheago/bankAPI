<?php

declare(strict_types=1);

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'forma_pagamento' => ['required', 'string', 'in:P,C,D'],
            'numero_conta' =>  ['required', 'numeric', 'min:1'],
            'valor' => ['required', 'numeric', 'min:1', 'decimal:0,4']
        ];
    }

    public function messages(): array
    {
        return [
            'forma_pagamento.required' => 'A forma de pagamento é obrigatória.',
            'forma_pagamento.string' => 'A forma de pagamento deve ser um enum (D, P ou C).',
            'forma_pagamento.in' => 'A forma de pagamento deve ser um enum (D, P ou C).',
            'numero_conta.required' => 'O número da conta é obrigatório.',
            'numero_conta.numeric' => 'O número da conta deve ser um número.',
            'numero_conta.min' => 'O número da conta deve ser maior que 0.',
            'valor.required' => 'O valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número.',
            'valor.min' => 'O valor mínimo é 1.',
            'valor.decimal' => 'O valor deve conter no máximo 4 digitos de centavos.'
        ];
    }
}
