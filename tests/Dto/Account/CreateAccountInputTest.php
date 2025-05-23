<?php

namespace Tests\Dto\Account;

use App\Dto\Account\AbstractCreateAccountInput;
use App\Dto\Account\CreateAccountInput;
use App\Enum\AmountStateEnum;
use App\ValueObject\Amount;
use Tests\TestCase;

class CreateAccountInputTest extends TestCase
{
    const int MICRO_BASE = 100000;

    protected function setUp(): void
    {
        parent::setUp();

        // A amount tratou a imprecisão dos float mas no teste fica dando assert errado pq arredonda.
        ini_set('precision', 17);
    }

    public function testGetAmountIntToStoreInSystem()
    {
        $randomFloat = $this->faker->randomFloat(nbMaxDecimals: 0, max: 9999);
        $amount = new Amount($randomFloat, AmountStateEnum::FLOAT);
        $accountNumber = $this->faker->randomNumber();

        $input = new CreateAccountInput($amount, $accountNumber);
        $this->assertEquals($randomFloat * self::MICRO_BASE, $input->getAmount());
        $this->assertEquals($accountNumber, $input->getAccountNumber());
        $this->assertInstanceOf(AbstractCreateAccountInput::class, $input);
    }
}
