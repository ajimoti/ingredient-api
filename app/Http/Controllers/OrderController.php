<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Http\Requests\OrderStoreRequest;

class OrderController extends Controller
{
    private $order;

    public function __construct(OrderService $order)
    {
        $this->order = $order;
    }

    public function fulfill(OrderStoreRequest $request)
    {
        $validated = $request->validated();

        return $this->sendJson(
            $this->order->fulfill($request)->toArray(),
            "Order gotten"
        );
    }

}
