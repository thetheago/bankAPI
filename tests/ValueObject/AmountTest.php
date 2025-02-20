<?php

namespace Tests\ValueObject;

use App\Enum\AmountStateEnum;
use App\ValueObject\Amount;
use Illuminate\Foundation\Testing\WithFaker;
use InvalidArgumentException;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class AmountTest extends TestCase
{
    use WithFaker;

    const int MICRO_BASE = 100000;

    protected function setUp(): void
    {
        parent::setUp();

        // A amount tratou a imprecisão dos float mas no teste fica dando assert errado pq arredonda.
        ini_set('precision', 17);
    }

    public function testNegativeAmount()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Saldo não deve ser negativo');
        new Amount(-3, AmountStateEnum::FLOAT);
    }

    /**
     * @dataProvider instanceNewAmountSucessfullyProvider
     */
    public function testInstanceNewAmountSucessfully($randomAmount)
    {
        $amount = new Amount($randomAmount, AmountStateEnum::FLOAT);
        $this->assertInstanceOf(Amount::class, $amount);
        $this->assertEquals($randomAmount, $amount->amount->value);
    }

    /**
     * @dataProvider instanceNewAmountSucessfullyProvider
     */
    public function testGetMicro($randomAmount)
    {
        $amount = new Amount($randomAmount, AmountStateEnum::FLOAT);
        $this->assertInstanceOf(Amount::class, $amount);
        $this->assertEquals($randomAmount, $amount->amount->value);
    }

    public function testGetFloatFromAmount()
    {
        $randomAmount = $this->faker->randomFloat(2, 0, 99);
        $amount = new Amount($randomAmount, AmountStateEnum::FLOAT);
        $this->assertEquals($randomAmount, $amount->getFloat());
    }

    public function testGetIntFromAmount()
    {
        $randomAmount = $this->faker->randomNumber(5);
        $amount = new Amount($randomAmount, AmountStateEnum::FLOAT);
        $this->assertEquals($randomAmount, $amount->getFloat());
    }

    public function testGetMicroBasedFromFloat()
    {
        $randomAmount = $this->faker->randomNumber(1);
        $amount = new Amount($randomAmount, AmountStateEnum::FLOAT);
        $this->assertEquals($randomAmount * self::MICRO_BASE, $amount->getMicro());
    }

    public function testGetMicroAfterGotFloat()
    {
        $randomAmount = $this->faker->randomNumber(1);
        $amount = new Amount($randomAmount, AmountStateEnum::FLOAT);
        $float = $amount->getFloat();
        assertEquals($randomAmount, $float);

        $this->assertEquals($randomAmount * self::MICRO_BASE, $amount->getMicro());
    }
}
