<?php

namespace App\Repositories\Interfaces;

interface BoxInterface
{
    public function create(Object $request);

    public function betweenDeliveryDates($firstDate, $secondDate);

    public function orderBoxes(object $request);
}
