<?php

declare(strict_types=1);

namespace App\Repository\Transaction;

use App\Dto\Transaction\TransactionInput;
use App\Interface\Transaction\ITransactionRepository;
use App\Models\Transaction;

class TransactionRepository implements ITransactionRepository
{
    public function storeTransaction(TransactionInput $input)
    {
        return Transaction::query()->create([
            'accountNumber' => $input->accountNumber,
            'amount' => $input->getAmount()
        ]);
    }
}
