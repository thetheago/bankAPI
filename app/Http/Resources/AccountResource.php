<?php

namespace App\Http\Resources;

use App\Dto\Account\CreateAccountOutput;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /* @var CreateAccountOutput $this */

        return [
            'numero_conta' => $this->getAccountNumber(),
            'saldo' => $this->getAmount()
        ];
    }
}
