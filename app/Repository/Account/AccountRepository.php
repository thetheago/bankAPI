<?php

declare(strict_types=1);

namespace App\Repository\Account;

use App\Interface\Account\IAccountRepository;
use App\Models\Account;

class AccountRepository implements IAccountRepository
{
    public function create(int $amount, int $accountNumber): Account
    {
        return Account::query()->create(
            [
                'amount' => $amount,
                'account_number' => $accountNumber
            ]
        );
    }
}
