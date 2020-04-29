<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Repositories\BoxRepository;
use App\Repositories\RecipeRepository;

class OrderService
{

    protected $box;
    protected $recipe;

    public function __construct(
        BoxRepository $box,
        RecipeRepository $recipe
    )
	{
		$this->box = $box;
		$this->recipe = $recipe;
    }

    public function fulfill(object $request)
    {
        $boxes = $this->box->orderBoxes($request);
        $ingredientsAndAmounts = $this->ingredientsToTotalAmounts($boxes);


        return collect($ingredientsAndAmounts);
    }

    private function ingredientsToTotalAmounts(object $boxes) : array
    {
        $ingredientsAndAmounts = [];
        foreach ($boxes as $box) {
            $recipeIngredients = $box->recipes->map->only(['ingredient_id', 'amount']);

            foreach ($recipeIngredients->toArray() as $value) {

                if (isset($ingredientsAndAmounts[$value['ingredient_id']])) {
                    $amount = $ingredientsAndAmounts[$value['ingredient_id']] + $value['amount'];
                }
                else {
                    $amount = $value['amount'];
                }

                $ingredientsAndAmounts[$value['ingredient_id']] = $amount;

            }
        }

        return $ingredientsAndAmounts;
    }

}
