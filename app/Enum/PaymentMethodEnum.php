<?php

declare(strict_types=1);

namespace App\Enum;

enum PaymentMethodEnum: string
{
    case CREDIT_CARD = 'C';
    case PIX = 'P';
    case DEBIT_CARD = 'D';
}
