<?php

declare(strict_types=1);

namespace App\Dto\Account;

class GetOneAccountInput
{
    public function __construct(private(set) int $accountNumber)
    {}
}
