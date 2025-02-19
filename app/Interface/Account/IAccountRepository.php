<?php

namespace App\Interface\Account;

use App\Models\Account;

interface IAccountRepository
{
    public function create(int $amount, int $accountNumber): Account;

    public function getOneByAccountNumber(int $accountNumber): Account;

    public function debit(int $version, int $accountNumber, int $amount, ?int $amountToDiscount): void;
}
