<?php

namespace Tests\Dto\Transaction;

use App\Dto\Account\AbstractCreateAccountInput;
use App\Dto\Account\CreateAccountInput;
use App\Dto\Transaction\AbstractTransactionDTO;
use App\Dto\Transaction\TransactionInput;
use App\Enum\AmountStateEnum;
use App\Enum\PaymentMethodEnum;
use App\ValueObject\Amount;
use Tests\TestCase;


class TransactionInputTest extends TestCase
{
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

        $input = new TransactionInput(PaymentMethodEnum::PIX, $accountNumber, $amount);
        $this->assertEquals($randomFloat * self::MICRO_BASE, $input->getAmount());
        $this->assertInstanceOf(AbstractTransactionDTO::class, $input);
    }
}
