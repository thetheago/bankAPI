<?php

declare(strict_types=1);

namespace App\Usecase\Account;

use App\Dto\Account\CreateAccountOutput;
use App\Dto\Account\GetOneAccountInput;
use App\Enum\AmountStateEnum;
use App\Interface\Account\IAccountRepository;
use App\ValueObject\Amount;

class GetOneAccount
{
    public function __construct(
        private IAccountRepository $accountRepository
    ) {}

    public function execute(GetOneAccountInput $input): CreateAccountOutput
    {
        $account = $this->accountRepository->getOneByAccountNumber($input->accountNumber);
        return new CreateAccountOutput(
            amount: new Amount((int) $account->getAttribute('amount'),
            amountState: AmountStateEnum::MICRO),
            accountNumber: $account->getAttribute('account_number')
        );
    }
}
