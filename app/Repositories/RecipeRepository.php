<?php

namespace App\Repositories;

use App\Recipe;
use App\Repositories\Interfaces\RecipeInterface;

class RecipeRepository extends BaseRepository implements RecipeInterface
{

   /**
    * IngredientRepository constructor.
    *
    * @param Ingredient $model
    */
   public function __construct(Recipe $model)
   {
       parent::__construct($model);
   }

   public function create(Object $request) : Object
   {
        $this->model->name  = $request->name;
        $this->model->description   = $request->description;
        $this->model->save();
        return $this->model;
   }
}
