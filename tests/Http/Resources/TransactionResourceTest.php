<?php

namespace Tests\Http\Resources;

use App\Dto\Account\CreateAccountOutput;
use App\Dto\Transaction\TransactionOutput;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use Mockery;
use ReflectionClass;
use Tests\TestCase;

class TransactionResourceTest extends TestCase
{
    public function testToArray()
    {
        $accountNumber = $this->faker->randomNumber();
        $amount = $this->faker->randomFloat();

        $request = Mockery::mock(Request::class);

        $output = Mockery::mock(TransactionOutput::class)->makePartial();
        $output->shouldReceive('getAmount')->andReturn($amount);
        $output->shouldReceive('getAccountNumber')->andReturn($accountNumber);

        $this->assertEquals(
            [
                'numero_conta' => $accountNumber,
                'saldo' => $amount
            ],
            TransactionResource::make($output)->toArray($request)
        );
    }
}
