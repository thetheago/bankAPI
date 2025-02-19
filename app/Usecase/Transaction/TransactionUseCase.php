<?php

declare(strict_types=1);

namespace App\Usecase\Transaction;

use App\Dto\Transaction\TransactionInput;
use App\Dto\Transaction\TransactionOutput;
use App\Factory\Transaction\TransactionStrategyFactory;
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
        $strategy = TransactionStrategyFactory::make($input->paymentMethod);
        $amountWithFee = $strategy->addFeeAndReturnNewAmount($input->getAmount());
        // Do lock optmist
    }
}
