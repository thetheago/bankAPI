<?php

namespace Tests\Http\Controllers;

use App\Exception\Account\AccountAlreadyExistException;
use App\Exception\Account\AccountNotFoundException;
use App\Http\Controllers\AccountController;
use App\Http\Requests\Account\CreateAccountRequest;

use App\Http\Requests\Account\GetOneAccountRequest;
use Mockery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;


class AccountControllerTest extends TestCase
{
    public function testCreateAccountSuccessfully()
    {
        $amount = $this->faker->randomFloat(nbMaxDecimals: 2, max: 99999);
        $accountNumber = $this->faker->randomNumber();

        $request = Mockery::mock(CreateAccountRequest::class);
        $request->shouldReceive('input')->with('saldo')->andReturn($amount);
        $request->shouldReceive('input')->with('numero_conta')->andReturn($accountNumber);

        $controller = new AccountController();
        $response = $controller->create($request);
        $responseData = $response->getData(true);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals($accountNumber, $responseData['numero_conta']);
        $this->assertEquals($amount, $responseData['saldo']);
    }

    public function testCreateAccountThatAlreadyExist()
    {
        $amount = $this->faker->randomFloat(nbMaxDecimals: 2, max: 99999);
        $accountNumber = $this->faker->randomNumber();

        $request = Mockery::mock(CreateAccountRequest::class);
        $request->shouldReceive('input')->with('saldo')->andReturn($amount);
        $request->shouldReceive('input')->with('numero_conta')->andReturn($accountNumber);

        $controller = new AccountController();
        $response = $controller->create($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        $this->expectException(AccountAlreadyExistException::class);
        $this->expectExceptionCode(Response::HTTP_CONFLICT);
        $this->expectExceptionMessage(sprintf('A conta %s já existe.', $accountNumber));

        $controller->create($request);
    }

    public function testeFetchAccountSucessfully()
    {
        $amount = $this->faker->randomFloat(nbMaxDecimals: 2, max: 99999);
        $accountNumber = $this->faker->randomNumber();

        $request = Mockery::mock(CreateAccountRequest::class);
        $request->shouldReceive('input')->with('saldo')->andReturn($amount);
        $request->shouldReceive('input')->with('numero_conta')->andReturn($accountNumber);

        $controller = new AccountController();
        $controller->create($request);


        // FETCH
        $requestFetch = Mockery::mock(GetOneAccountRequest::class);
        $requestFetch->shouldReceive('get')->with('numero_conta')->andReturn($accountNumber);

        $response = $controller->fetchOne($requestFetch);
        $responseData = $response->getData(true);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals($accountNumber, $responseData['numero_conta']);
        $this->assertEquals($amount, $responseData['saldo']);
    }

    public function searchInexistentAccount(): void
    {
        $controller = new AccountController();
        $accountNumber = $this->faker->randomNumber();

        $requestFetch = Mockery::mock(GetOneAccountRequest::class);
        $requestFetch->shouldReceive('get')->with('numero_conta')->andReturn($accountNumber);

        $this->expectException(AccountNotFoundException::class);
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);
        $this->expectExceptionMessage(sprintf('A conta %s não foi encontrada.', $accountNumber),);

        $controller->fetchOne($requestFetch);
    }
}
