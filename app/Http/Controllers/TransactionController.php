<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factory\Transaction\TransactionInputFactory;
use App\Http\Resources\TransactionResource;
use App\Repository\Account\AccountRepository;
use App\Repository\Transaction\TransactionRepository;
use App\Usecase\Transaction\TransactionUseCase;
use Illuminate\Http\JsonResponse;

use App\Http\Requests\Transaction\TransactionRequest;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    public function transact(TransactionRequest $request): JsonResponse
    {
        $input = TransactionInputFactory::createFromRequest($request);

        $useCase = new TransactionUseCase(
            accountRepository: new AccountRepository(),
            transactionRepository:  new TransactionRepository()
        );

        $output = $useCase->execute($input);

        return TransactionResource::make($output)->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
