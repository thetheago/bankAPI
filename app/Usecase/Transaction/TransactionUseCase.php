<?php

namespace App\Usecase\Transaction;

use App\Dto\Transaction\TransactionInput;
use App\Dto\Transaction\TransactionOutput;
use App\Interface\Account\IAccountRepository;
use App\Interface\Transaction\ITransactionRepository;

class TransactionUseCase
{
    public function __construct(
        private IAccountRepository $accountRepository,
        private ITransactionRepository $transactionRepository
    )
    {}

    public function execute(TransactionInput $input): TransactionOutput
    {
        // Logic
        // Strategy to fee
        // Optmist Lock
    }
}
