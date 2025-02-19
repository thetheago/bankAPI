<?php

declare(strict_types=1);

namespace App\Enum;

enum PaymentMethodEnum: string
{
    case CREDIT = 'C';
    case PIX = 'P';
    case DEBIT = 'D';
}
