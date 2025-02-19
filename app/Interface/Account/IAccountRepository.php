<?php

namespace App\Interface\Account;

use App\Models\Account;

interface IAccountRepository
{
    public function create(int $amount, int $accountNumber): Account;
}
