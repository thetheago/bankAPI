<?php

namespace App\Exception\Account;

use DomainException;
use Symfony\Component\HttpFoundation\Response;

use App\Interface\ICustomException;

class AccountNotFoundException extends DomainException implements ICustomException
{
    public static function create($id = null): self
    {
        return new self(
            message: sprintf('A conta %s não foi encontrada.', $id),
            code: Response::HTTP_NOT_FOUND
        );
    }
}
