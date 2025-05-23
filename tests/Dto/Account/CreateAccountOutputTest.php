<?php

namespace Tests\Dto\Account;


use App\Dto\Account\AbstractCreateAccountInput;
use App\Dto\Account\CreateAccountOutput;
use App\Enum\AmountStateEnum;
use App\ValueObject\Amount;
use Tests\TestCase;

class CreateAccountOutputTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // A amount tratou a imprecisão dos float mas no teste fica dando assert errado pq arredonda.
        ini_set('precision', 17);
    }

    public function testGetAmountFloatToOutput()
    {
        $randomFloat = $this->faker->randomFloat();
        $amount = new Amount($randomFloat, AmountStateEnum::FLOAT);
        $accountNumber = $this->faker->randomNumber();
        $output = new CreateAccountOutput($amount, $accountNumber);
        $this->assertEquals($randomFloat, $output->getAmount());
        $this->assertInstanceOf(AbstractCreateAccountInput::class, $output);
    }
}
