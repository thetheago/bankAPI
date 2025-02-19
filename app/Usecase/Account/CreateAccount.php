<?php

declare(strict_types=1);

namespace App\Usecase\Account;

use App\Dto\Account\CreateAccountInput;
use App\Dto\Account\CreateAccountOutput;
use App\Interface\Account\IAccountRepository;
use App\Models\Account;
use App\ValueObject\Amount;

class CreateAccount
{
    private IAccountRepository $accountRepository;

    public function __construct(IAccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function execute(CreateAccountInput $input): CreateAccountOutput
    {
        $account = $this->accountRepository->create($input->getAmount(), $input->getAccountNumber());
        return new CreateAccountOutput(amount: new Amount($account->getAttribute('amount')),
            accountNumber: $account->getAttribute('account_number')
        );
    }
}
