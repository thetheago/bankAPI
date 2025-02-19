<?php

declare(strict_types=1);

namespace App\Exception\Transaction;

use App\Enum\PaymentMethodEnum;
use App\Interface\ICustomException;
use DomainException;
use Symfony\Component\HttpFoundation\Response;

class NotEnoughCashStrangerException extends DomainException implements ICustomException
{
    public static function create(int $accountNumber, PaymentMethodEnum $paymentMethodEnum): self
    {
        return match ($paymentMethodEnum) {
            PaymentMethodEnum::PIX    => self::message(
                sprintf('A conta %s não tem dinheiro suficiente para realizar a transação.', $accountNumber)
            ),
            PaymentMethodEnum::CREDIT => self::message(
                sprintf('A conta %s não tem dinheiro suficiente para realizar a transação.', $accountNumber)
            ),
            PaymentMethodEnum::DEBIT  => self::message(
                sprintf('A conta %s não tem dinheiro suficiente para realizar a transação.', $accountNumber)
            ),
        };
    }

    private static function message(String  $message): self
    {
        return new self(
            message: $message,
            code: Response::HTTP_NOT_FOUND
        );
    }
}
