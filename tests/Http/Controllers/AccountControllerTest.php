<?php

namespace Tests\Http\Controllers;

use App\Dto\Account\CreateAccountInput;
use App\Dto\Account\CreateAccountOutput;
use App\Http\Controllers\AccountController;
use App\Http\Requests\Account\CreateAccountRequest;
use App\Models\Account;
use App\Usecase\Account\CreateAccount;
use App\ValueObject\Amount;
use Mockery;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
//    protected function setUp(): void
//    {
//        parent::setUp();
//
//        $this->useCaseMock = Mockery::mock(CreateAccount::class);
//        $this->createAccountInputMock = Mockery::mock(CreateAccountInput::class);
////        $this->controller  = new AccountsController($this->serviceMock);
//    }

//    public function testShouldFetchAccountSucessfully()
//    {
//        $accountNumber = $this->faker->randomNumber(5);
//        $amount = $this->faker->randomFloat(nbMaxDecimals: 2, max: 99999);
////
////        $createAccountInput = new CreateAccountInput(new Amount($amount), $accountNumber);
////
////        $account  = new Account(['account_number' => $accountNumber, 'amount' => $amount]);
////        $mockedContent = json_encode(['numero_conta' => $accountNumber, 'saldo' => $amount]);
////
////        $createAccountOutput = new CreateAccountOutputTest(amount: new Amount($amount), accountNumber: $accountNumber);
////
////        $this->useCaseMock->shouldReceive('execute')
////            ->with($createAccountInput)
////            ->andReturn($createAccountOutput);
//
//        $request = Mockery::mock(CreateAccountRequest::class);
//        $request->shouldReceive('input')->with('numero_conta')->andReturn($accountNumber);
//
//        $response = $this->controller->showAccount($request);
//
//        // Validações do resultado
//        $content  = $response->getContent();
//        $status   = $response->getStatusCode();
//
//        // Valide que o retorno é do tipo JSON
//        $this->assertInstanceOf(JsonResponse::class, $response);
//        $this->assertJson($content);
//
//        // Compara conteúdo retornado
//        $this->assertEquals($mockedContent, $content);
//
//        // Verifica o status HTTP retornado
//        $this->assertEquals(Response::HTTP_OK, $status);
//
//    }
}
