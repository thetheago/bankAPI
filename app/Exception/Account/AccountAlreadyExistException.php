<?php

namespace App\Exception\Account;

use App\Interface\ICustomException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class AccountAlreadyExistException extends ConflictHttpException implements ICustomException
{
    public static function create($id = null): self
    {
        return new self(
            message: sprintf('A conta %s já existe.', $id),
            code: Response::HTTP_CONFLICT
        );
    }
}
