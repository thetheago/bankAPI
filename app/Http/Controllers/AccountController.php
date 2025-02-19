<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccountRequest;
use App\Factory\Account\CreateAccountInputFactory;
use App\Interface\ICustomException;
use App\Repository\Account\AccountRepository;
use App\Usecase\Account\CreateAccount;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    public function create(CreateAccountRequest $request): JsonResponse
    {
        try {
            $input = CreateAccountInputFactory::createFromRequest($request);

            $useCase = new CreateAccount(new AccountRepository());
            $output = $useCase->execute($input);

            return response()->json([
                'numero_conta' => $output->getAccountNumber(),
                'saldo' => $output->getAmount()
            ])->setStatusCode(Response::HTTP_CREATED);
        } catch (ICustomException $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode($e->getCode());
        }
    }
}
