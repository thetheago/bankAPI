<?php

namespace Tests\Http\Resources;

use App\Dto\Account\CreateAccountOutput;
use App\Http\Resources\AccountResource;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class AccountResourceTest extends TestCase
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

        $output = Mockery::mock(CreateAccountOutput::class);
        $output->shouldReceive('getAccountNumber')->andReturn($accountNumber);
        $output->shouldReceive('getAmount')->andReturn($amount);

        $this->assertEquals(
            [
                'numero_conta' => $accountNumber,
                'saldo' => $amount
            ],
            AccountResource::make($output)->toArray($request)
        );
    }
}
