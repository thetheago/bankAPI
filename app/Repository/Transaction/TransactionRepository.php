<?php

declare(strict_types=1);

namespace App\Repository\Transaction;

use App\Dto\Transaction\TransactionInput;
use App\Interface\Transaction\ITransactionRepository;

class TransactionRepository implements ITransactionRepository
{
    public function doTransaction(TransactionInput $input)
    {
        // TODO: Implement doTransaction() method.
    }
}
