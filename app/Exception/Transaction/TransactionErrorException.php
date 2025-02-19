<?php

namespace App\Exception\Transaction;

use App\Interface\ICustomException;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class TransactionErrorException extends RuntimeException implements ICustomException
{
    public static function create(): self
    {
        return new self(
            message: 'Algo deu errado na sua transação, por favor tente novamente.',
            code: Response::HTTP_BAD_REQUEST
        );
    }
}
