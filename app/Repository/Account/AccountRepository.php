<?php

declare(strict_types=1);

namespace App\Repository\Account;

use App\Exception\Account\AccountNotFoundException;
use App\Exception\Transaction\TransactionErrorException;
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

    public function getOneByAccountNumber(int $accountNumber): Account
    {
        try {
            return Account::query()->where('account_number', $accountNumber)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw AccountNotFoundException::create($accountNumber);
        }
    }

    public function debit(int $version, int $accountNumber, int $amount, ?int $amountToDiscount): void
    {
        $affectedRows = Account::query()
            ->where('account_number', $accountNumber)
            ->where('version', $version) // Lock optmist
            ->update([
                'amount' => ($amount - $amountToDiscount),
                'version' => $version + 1
            ]);

        if ($affectedRows === 0) { // Means that the version already changed by another thread.
            throw TransactionErrorException::create();
        }
    }
}
