<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\RecipeRepository;

class RecipeService
{

    protected $recipe;
    public function __construct(RecipeRepository $recipe)
	{
		$this->recipe = $recipe;
    }

    public function paginate() : object
    {
        return $this->recipe->paginate();
    }

    public function create(Object $request) : object
    {

        $recipe = DB::transaction( function () use ($request) {
            $recipe = $this->recipe->create($request);
            $recipe->ingredients()->attach(
                $this->structureIngredientRequest($request->ingredients)
            );

            return $recipe->load('ingredients');
        });

        return $recipe;
    }

    protected function structureIngredientRequest(array $ingredients) : array
    {
        $result = [];
        foreach ($ingredients as $ingredient) {
            $result[$ingredient['id']] =  [
                'amount' => $ingredient['amount']
            ];
        }

        return $result;
    }

}
