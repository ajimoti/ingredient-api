<?php

namespace App\Repositories;

use App\Ingredient;
use App\Repositories\Interfaces\IngredientInterface;

class IngredientRepository extends BaseRepository implements IngredientInterface
{

   /**
    * IngredientRepository constructor.
    *
    * @param Ingredient $model
    */
   public function __construct(Ingredient $model)
   {
       parent::__construct($model);
   }

   public function create(Object $request) : Object
   {
        $this->model->name      = $request->name;
        $this->model->measure   = $request->measure;
        $this->model->supplier  = $request->supplier;
        $this->model->save();

        return $this->model;
   }
}
