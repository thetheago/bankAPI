<?php

namespace App\Interface\Transaction;

use App\ValueObject\Amount;

interface ITransactionStrategy
{
    /* Não altera o valor do objeto passado.*/
    public function addFeeAndReturnNewAmount(int $amount): int;
}
