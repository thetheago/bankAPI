<?php

namespace Tests\Http\Controllers;

use App\Enum\AmountStateEnum;
use App\Enum\PaymentMethodEnum;
use App\Exception\Transaction\NotEnoughCashStrangerException;
use App\Factory\Transaction\TransactionStrategyFactory;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Requests\Account\CreateAccountRequest;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Models\Account;
use App\Models\Transaction;
use App\ValueObject\Amount;
use BcMath\Number;
use Mockery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;


class TransactionControllerTest extends TestCase
{
    private function createAccount(float|int $amount, int $accountNumber): void
    {
        $request = Mockery::mock(CreateAccountRequest::class);
        $request->shouldReceive('input')->with('saldo')->andReturn($amount);
        $request->shouldReceive('input')->with('numero_conta')->andReturn($accountNumber);

        $controller = new AccountController();
        $controller->create($request);
    }

    public function testMakeTransactionSucessfullyWithPix()
    {
        $amount = 3000.25;
        $valueToTransfer = 2146.88;
        $accountNumber = $this->faker->randomNumber();

        $this->createAccount($amount, $accountNumber);

        $paymentMethod = PaymentMethodEnum::PIX->value;

        $request = Mockery::mock(TransactionRequest::class);
        $request->shouldReceive('input')->with('forma_pagamento')->andReturn($paymentMethod);
        $request->shouldReceive('input')->with('numero_conta')->andReturn($accountNumber);
        $request->shouldReceive('input')->with('valor')->andReturn($valueToTransfer);

        $controller = new TransactionController();
        $response = $controller->transact($request);
        $responseData = $response->getData(true);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals($accountNumber, $responseData['numero_conta']);

        $transactionEntity = Transaction::query()->firstOrFail()->toArray();
        $accountEntity = Account::query()->firstOrFail()->toArray();

        // Verifying lock optmist logic
        $this->assertEquals(2, $accountEntity['version']);

        $originalAmount = new Amount($amount, AmountStateEnum::FLOAT)->getMicro();
        $valueToTransferAmount = new Amount($valueToTransfer, AmountStateEnum::FLOAT)->getMicro();


        $this->assertEquals(
            $accountEntity['amount'],
            $originalAmount - $valueToTransferAmount
        );
    }

    public function testMakeTransactionSucessfullyWithDebit()
    {
        $amount = 3000.25;
        $valueToTransfer = 2146.88;
        $fee = 1.03;

        $accountNumber = $this->faker->randomNumber();

        $this->createAccount($amount, $accountNumber);

        $paymentMethod = PaymentMethodEnum::DEBIT;

        $request = Mockery::mock(TransactionRequest::class);
        $request->shouldReceive('input')->with('forma_pagamento')->andReturn($paymentMethod->value);
        $request->shouldReceive('input')->with('numero_conta')->andReturn($accountNumber);
        $request->shouldReceive('input')->with('valor')->andReturn($valueToTransfer);

        $controller = new TransactionController();
        $response = $controller->transact($request);
        $responseData = $response->getData(true);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals($accountNumber, $responseData['numero_conta']);

        $transactionEntity = Transaction::query()->firstOrFail()->toArray();
        $accountEntity = Account::query()->firstOrFail()->toArray();

        // Verifying lock optmist logic
        $this->assertEquals(2, $accountEntity['version']);

        $originalAmount = new Amount($amount, AmountStateEnum::FLOAT)->getMicro();
        $valueToTransferAmount = new Amount($valueToTransfer, AmountStateEnum::FLOAT)->getMicro();

        $valueToTransferAmount *= $fee;

        $this->assertEquals(
            $accountEntity['amount'],
            $originalAmount - $valueToTransferAmount
        );
    }

    public function testMakeTransactionSucessfullyWithCredit()
    {
        $amount = 3000.25;
        $valueToTransfer = 2146.88;
        $fee = 1.05;

        $accountNumber = $this->faker->randomNumber();

        $this->createAccount($amount, $accountNumber);

        $paymentMethod = PaymentMethodEnum::CREDIT;

        $request = Mockery::mock(TransactionRequest::class);
        $request->shouldReceive('input')->with('forma_pagamento')->andReturn($paymentMethod->value);
        $request->shouldReceive('input')->with('numero_conta')->andReturn($accountNumber);
        $request->shouldReceive('input')->with('valor')->andReturn($valueToTransfer);

        $controller = new TransactionController();
        $response = $controller->transact($request);
        $responseData = $response->getData(true);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals($accountNumber, $responseData['numero_conta']);

        $transactionEntity = Transaction::query()->firstOrFail()->toArray();
        $accountEntity = Account::query()->firstOrFail()->toArray();

        // Verifying lock optmist logic
        $this->assertEquals(2, $accountEntity['version']);

        $originalAmount = new Amount($amount, AmountStateEnum::FLOAT)->getMicro();
        $valueToTransferAmount = new Amount($valueToTransfer, AmountStateEnum::FLOAT)->getMicro();

        $valueToTransferAmount *= $fee;

        $this->assertEquals(
            $accountEntity['amount'],
            $originalAmount - $valueToTransferAmount
        );
    }

    public function testNotEnoghCashTransaction()
    {
        $amount = 2000.25;
        $valueToTransfer = 2146.88;
        $fee = 1.05;

        $accountNumber = $this->faker->randomNumber();

        $this->createAccount($amount, $accountNumber);

        $paymentMethod = PaymentMethodEnum::CREDIT;

        $request = Mockery::mock(TransactionRequest::class);
        $request->shouldReceive('input')->with('forma_pagamento')->andReturn($paymentMethod->value);
        $request->shouldReceive('input')->with('numero_conta')->andReturn($accountNumber);
        $request->shouldReceive('input')->with('valor')->andReturn($valueToTransfer);

        $this->expectException(NotEnoughCashStrangerException::class);
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);
        $this->expectExceptionMessage(sprintf('A conta %s não tem dinheiro suficiente para realizar a transação.', $accountNumber));

        $controller = new TransactionController();
        $controller->transact($request);
    }
}
