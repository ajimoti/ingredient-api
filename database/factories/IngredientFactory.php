<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ingredient;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function (Faker $faker) {
    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

    $measures = (new Ingredient())->measures();

    return [
        "name"  => $faker->fruitName(),
        "measure"  => $measures[array_rand($measures)],
        "supplier"  => $faker->name,
    ];
});
