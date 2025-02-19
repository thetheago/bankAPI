<?php

declare(strict_types=1);

namespace App\Interface\Transaction;

use App\Dto\Transaction\TransactionInput;

interface ITransactionRepository
{
    public function storeTransaction(TransactionInput $input);
}
