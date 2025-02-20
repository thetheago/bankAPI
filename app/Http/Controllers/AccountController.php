<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\ValueObject\Amount;
use Illuminate\Http\JsonResponse;

use App\Factory\Account\CreateAccountInputFactory;
use App\Factory\Account\GetOneAccountInputFactory;
use App\Http\Requests\Account\CreateAccountRequest;
use App\Http\Requests\Account\GetOneAccountRequest;
use App\Http\Resources\AccountResource;
use App\Repository\Account\AccountRepository;
use App\Usecase\Account\CreateAccount;
use App\Usecase\Account\GetOneAccount;
use Symfony\Component\HttpFoundation\Response;

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
        $teste = new Amount(12345.1234989);
        dd($teste->getMicro());


        $input = GetOneAccountInputFactory::createFromRequest($request);
        $useCase = new GetOneAccount(new AccountRepository());
        $output = $useCase->execute($input);

        return AccountResource::make($output)->response()->setStatusCode(Response::HTTP_OK);
    }
}
