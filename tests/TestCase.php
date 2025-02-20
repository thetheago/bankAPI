<?php

namespace Tests;

use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;

    public static function testInstanceNewAmountSucessfullyProvider()
    {
        $faker = Factory::create();

        return [
            'Float case' => [$faker->randomFloat(min: 1, max: 999999)],
            'Int case' => [$faker->randomNumber(5)]
        ];
    }
}
