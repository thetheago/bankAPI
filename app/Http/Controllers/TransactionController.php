<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factory\Transaction\TransactionInputFactory;
use Illuminate\Http\JsonResponse;

use App\Http\Requests\Transaction\TransactionRequest;

class TransactionController extends Controller
{
    public function transact(TransactionRequest $request): JsonResponse
    {
        $input = TransactionInputFactory::createFromRequest($request);

        $useCase = new CreateAccount(new AccountRepository());
//        $output = $useCase->execute($input);
//
//        return AccountResource::make($output)->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
