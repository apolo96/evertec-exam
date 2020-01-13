<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_name' => $faker->name,
        'customer_email' => $faker->unique()->safeEmail,
        'customer_mobile' => $faker->phoneNumber,
        'pay_id' => $faker->sha1,
        'pay_process_url' => $faker->url
    ];
});
