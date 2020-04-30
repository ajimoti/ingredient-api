<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\IngredientRecipe;
use Faker\Generator as Faker;

$factory->define(IngredientRecipe::class, function (Faker $faker) {
    return [
        "amount" => $faker->randomDigit,
        "recipe_id" => factory(App\Recipe::class)->create()->id,
        "ingredient_id" => factory(App\Ingredient::class)->create()->id,
    ];
});
