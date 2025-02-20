<?php

namespace Tests\Dto\Transaction;

use App\Dto\Account\AbstractCreateAccountInput;
use App\Dto\Account\CreateAccountInput;
use App\Dto\Transaction\AbstractTransactionDTO;
use App\Dto\Transaction\TransactionInput;
use App\Dto\Transaction\TransactionOutput;
use App\Enum\PaymentMethodEnum;
use App\ValueObject\Amount;
use Tests\TestCase;


class TransactionOutputTest extends TestCase
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
        $amount = new Amount($randomFloat);
        $accountNumber = $this->faker->randomNumber();

        $input = new TransactionOutput($accountNumber, $amount);
        $this->assertEquals($randomFloat, $input->getAmount());
        $this->assertEquals($accountNumber, $input->getAccountNumber());
        $this->assertInstanceOf(AbstractTransactionDTO::class, $input);
    }
}
