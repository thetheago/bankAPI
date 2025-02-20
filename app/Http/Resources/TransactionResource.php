<?php

namespace App\Http\Resources;

use App\Dto\Transaction\TransactionOutput;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var TransactionOutput $this */

        return [
            'numero_conta' => $this->getAccountNumber(),
            'saldo' => $this->getAmount()
        ];
    }
}
