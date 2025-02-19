<?php

declare(strict_types=1);

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class GetOneAccountRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'numero_conta.required' => 'O número da conta é obrigatório.',
            'numero_conta.numeric' => 'O número da conta deve ser um número.',
            'numero_conta.min' => 'O número da conta deve ser maior que 0',
        ];
    }
}
