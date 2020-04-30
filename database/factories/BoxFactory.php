<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Box;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Box::class, function (Faker $faker) {
    return [
        "user_id" => factory(App\User::class)->create()->id,
        "delivery_date" => Carbon::now()->addDays(rand(1, 10)),
    ];
});
