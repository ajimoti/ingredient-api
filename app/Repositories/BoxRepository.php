<?php

namespace App\Repositories;

use App\Box;
use App\Repositories\Interfaces\BoxInterface;

class BoxRepository extends BaseRepository implements BoxInterface
{

   /**
    * IngredientRepository constructor.
    *
    * @param Ingredient $model
    */
   public function __construct(Box $model)
   {
       parent::__construct($model);
   }

   public function create(Object $request) : Object
   {
        $this->model->user_id  = $request->user_id;
        $this->model->delivery_date   = $request->delivery_date;
        $this->model->save();

        return $this->model;
   }
}
