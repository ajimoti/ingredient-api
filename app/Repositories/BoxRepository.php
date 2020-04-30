<?php

namespace App\Repositories;

use App\Box;
use Carbon\Carbon;
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

   public function betweenDeliveryDates($firstDate, $secondDate) : Object
   {
        return $this->model->betweenDeliveryDates($firstDate, $secondDate);
   }

    public function orderBoxes(object $request) : object
    {
        $orderDate = Carbon::parse($request->order_date);
        $sevenDaysFromOrderDate = Carbon::parse($request->order_date)->addDays(7);

        $boxes = $this->filters(
            $request,
            $this->model->betweenDeliveryDates($orderDate, $sevenDaysFromOrderDate)
        );
// dd($boxes->toSql());
        return $boxes->get();
    }

    private function filters(object $request, object $boxes)
    {
        if ($request->has('delivery_date')) {
            $boxes->deliveryDate($request->input('delivery_date'));
        }

        if ($request->has('supplier')) {
            $boxes->supplier(
                explode(",", $request->input('supplier'))
            );
        }

        return $boxes;
    }
}
