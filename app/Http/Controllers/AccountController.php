<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\GetOneAccountRequest;
use App\Http\Resources\AccountResource;
use App\Usecase\Account\GetOneAccount;
use App\Usecase\Account\CreateAccount;
use App\Http\Requests\CreateAccountRequest;
use App\Repository\Account\AccountRepository;
use App\Factory\Account\GetOneAccountInputFactory;
use App\Factory\Account\CreateAccountInputFactory;

class AccountController extends Controller
{
    public function create(CreateAccountRequest $request): JsonResponse
    {
        $input = CreateAccountInputFactory::createFromRequest($request);

        $useCase = new CreateAccount(new AccountRepository());
        $output = $useCase->execute($input);

        return AccountResource::make($output)->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function fetchOne(GetOneAccountRequest $request): JsonResponse
    {
        $input = GetOneAccountInputFactory::createFromRequest($request);
        $useCase = new GetOneAccount(new AccountRepository());
        $output = $useCase->execute($input);

        return AccountResource::make($output)->response()->setStatusCode(Response::HTTP_OK);
    }
}
