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
    protected function setUp(): void
    {
        parent::setUp();

        // A amount tratou a imprecisão dos float mas no teste fica dando assert errado pq arredonda.
        ini_set('precision', 17);
    }

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
