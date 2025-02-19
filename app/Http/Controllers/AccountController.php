<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Usecase\Account\GetOneAccount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Interface\ICustomException;
use App\Usecase\Account\CreateAccount;
use App\Http\Requests\CreateAccountRequest;
use App\Repository\Account\AccountRepository;
use App\Factory\Account\GetOneAccountInputFactory;
use App\Factory\Account\CreateAccountInputFactory;

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

    public function fetchOne(Request $request): JsonResponse
    {
        $input = GetOneAccountInputFactory::createFromRequest($request);
        $useCase = new GetOneAccount(new AccountRepository());
        $output = $useCase->execute($input);

        return response()->json([
            'numero_conta' => $output->getAccountNumber(),
            'saldo' => $output->getAmount()
        ])->setStatusCode(Response::HTTP_OK);
    }
}
