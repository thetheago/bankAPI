<?php

declare(strict_types=1);

namespace App\Usecase\Transaction;

use App\Dto\Transaction\TransactionInput;
use App\Dto\Transaction\TransactionOutput;
use App\Enum\AmountStateEnum;
use App\Exception\Transaction\NotEnoughCashStrangerException;
use App\Factory\Transaction\TransactionStrategyFactory;
use App\Interface\Account\IAccountRepository;
use App\Interface\Transaction\ITransactionRepository;
use App\ValueObject\Amount;

class TransactionUseCase
{
    public function __construct(
        private readonly IAccountRepository $accountRepository,
        private readonly ITransactionRepository $transactionRepository
    )
    {}

    public function execute(TransactionInput $input): TransactionOutput
    {
        $strategy = TransactionStrategyFactory::make($input->paymentMethod);
        $amountWithFeeToDiscount = $strategy->addFeeAndReturnNewAmount($input->getAmount());

        $accountModel = $this->accountRepository->getOneByAccountNumber($input->accountNumber);
        $accountAmount = $accountModel->getAttribute("amount");

        if ($accountAmount < $amountWithFeeToDiscount) {
            throw NotEnoughCashStrangerException::create($input->accountNumber, $input->paymentMethod);
        }

        $this->accountRepository->debit(
            version: $accountModel->getAttribute("version"),
            accountNumber: $input->accountNumber,
            amount: $accountAmount,
            amountToDiscount: $amountWithFeeToDiscount
        );

        $this->transactionRepository->storeTransaction($input);

        return new TransactionOutput(
            accountNumber: $input->accountNumber,
            amount: new Amount($accountAmount - $amountWithFeeToDiscount, AmountStateEnum::MICRO)
        );
    }
}
