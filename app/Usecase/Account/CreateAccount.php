<?php

declare(strict_types=1);

namespace App\Usecase\Account;

use App\Dto\Account\CreateAccountInput;
use App\Dto\Account\CreateAccountOutput;
use App\Exception\Account\AccountAlreadyExistException;
use App\Interface\Account\IAccountRepository;
use App\ValueObject\Amount;
use Illuminate\Database\UniqueConstraintViolationException;

class CreateAccount
{
    public function __construct(private IAccountRepository $accountRepository)
    {
    }

    public function execute(CreateAccountInput $input): CreateAccountOutput
    {
        try {
            $account = $this->accountRepository->create($input->getAmount(), $input->getAccountNumber());

            return new CreateAccountOutput(amount: new Amount($account->getAttribute('amount')),
                accountNumber: $account->getAttribute('account_number')
            );
        } catch (UniqueConstraintViolationException $e) {
            throw AccountAlreadyExistException::create($input->getAccountNumber());
        }
    }
}
