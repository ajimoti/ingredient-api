<?php

namespace App\Services;

use App\BoxRecipe;
use Illuminate\Support\Facades\DB;
use App\Repositories\BoxRepository;

class BoxService
{
    protected $box;
    protected $boxRecipe;

    public function __construct(BoxRepository $box, BoxRecipe $BoxRecipe)
	{
		$this->box = $box;
		$this->boxRecipe = $BoxRecipe;
    }

    public function paginate() : object
    {
        return $this->box->paginate();
    }

    public function create(Object $request) : object
    {
        $box = DB::transaction( function () use ($request) {
            $box = $this->box->create($request);

            $this->boxRecipe->insert(
                $this->structureRecipeRequest($request->recipe_ids, $box->id)
            );

            return $box->load('recipes');
        });

        return $box;
    }

    protected function structureRecipeRequest(array $recipes, $boxId) : array
    {
        $result = [];
        foreach ($recipes as $recipe) {
            array_push($result, [
                'box_id'  => $boxId,
                'recipe_id'  => $recipe
            ]);
        }

        return $result;
    }

}
