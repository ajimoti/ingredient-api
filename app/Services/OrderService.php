<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Repositories\BoxRepository;
use App\Repositories\RecipeRepository;

class OrderService
{

    protected $box;
    protected $recipe;

    public function __construct(BoxRepository $box, RecipeRepository $recipe)
	{
		$this->box = $box;
		$this->recipe = $recipe;
    }

    public function fulfill(object $request) : object
    {
        $boxes = $this->box->orderBoxes($request);

        $ingredientsAndAmounts = $this->ingredientsToTotalAmount($boxes);

        return collect($ingredientsAndAmounts);
    }

    private function ingredientsToTotalAmount(object $boxes) : array
    {
        $response = [];
        foreach ($boxes as $box) {
            $recipeAndIngredients = $box->recipes->map->only(['ingredient_id', 'amount', 'ingredient']);

            foreach ($recipeAndIngredients->toArray() as $ingredient) {
                $amount = $this->sumAmount($response, $ingredient);
                $response = $this->structureResponse($response, $ingredient, $amount);
            }
        }

        return array_values($response);
    }


    private function sumAmount(array $response, array $ingredient) : int
    {
        if (isset($response[$ingredient['ingredient_id']])) {
            $amount = $response[$ingredient['ingredient_id']]['ingredient_amount'] + $ingredient['amount'];
        }
        else {
            $amount = $ingredient['amount'];
        }

        return $amount;
    }

    private function structureResponse(array $response, array $ingredient, $amount) : array
    {
        $response[$ingredient['ingredient_id']]['ingredient_id'] = $ingredient['ingredient_id'];
        $response[$ingredient['ingredient_id']]['ingredient_name'] = $ingredient['ingredient']->name;
        $response[$ingredient['ingredient_id']]['ingredient_amount'] = $amount;
        $response[$ingredient['ingredient_id']]['ingredient_measure'] = $ingredient['ingredient']->measure;

        return $response;
    }
}
