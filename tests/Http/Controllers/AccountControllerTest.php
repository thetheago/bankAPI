<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\AccountController;
use App\Http\Requests\Account\CreateAccountRequest;
use Mockery;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $this->assertEquals($accountNumber, $responseData['numero_conta']);
        $this->assertEquals($amount, $responseData['saldo']);
    }

//    public function testCreateAccountThatAlreadyExist()
//    {
//
//    }
//
//    public function testCreateAccountWithWrongParameters()
//    {
//
//    }
}
