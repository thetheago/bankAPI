<?php

declare(strict_types=1);

namespace App\Repository\Account;

use App\Exception\Account\AccountNotFoundException;
use App\Interface\Account\IAccountRepository;
use App\Models\Account;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function getOneByAccountNumber(int $accountId): Account
    {
        try {
            return Account::query()->where('account_number', $accountId)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw AccountNotFoundException::create($accountId);
        }
    }
}
