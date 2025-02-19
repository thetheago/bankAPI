<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Http\Requests\Transaction\TransactionRequest;

class TransactionController extends Controller
{
    public function transact(TransactionRequest $request): JsonResponse
    {
        return response()->json();
    }
}
