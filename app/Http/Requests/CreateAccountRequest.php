<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'numero_conta' => 'required|numeric|min:1',
            'saldo' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'numero_conta.required' => 'O número da conta é obrigatório.',
            'numero_conta.numeric' => 'O número da conta deve ser um número.',
            'numero_conta.min' => 'O número da conta deve ser maior que 0',
            'saldo.required' => 'O saldo é obrigatório.',
            'saldo.numeric' => 'O saldo deve ser um número.',
            'saldo.min' => 'O saldo deve ser um número maior que 0.'
        ];
    }
}
