<?php

namespace Tests;

use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;

    const int MICRO_BASE = 100000;

    protected function setUp(): void
    {
        parent::setUp();
        ini_set('precision', 17);
        $this->getConnection()->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->getConnection()->rollBack();
        parent::tearDown();
    }

    public static function instanceNewAmountSucessfullyProvider()
    {
        $faker = Factory::create();

        return [
            'Float case' => [$faker->randomFloat(min: 1, max: 999999)],
            'Int case' => [$faker->randomNumber(5)]
        ];
    }
}
