<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BoxRecipe;
use Faker\Generator as Faker;

$factory->define(BoxRecipe::class, function (Faker $faker) {
    return [
        "recipe_id" => factory(App\Recipe::class)->create()->id,
        "box_id" => factory(App\Box::class)->create()->id,
    ];
});
