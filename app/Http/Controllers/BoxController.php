<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BoxService;
use App\Http\Requests\BoxStoreRequest;

class BoxController extends Controller
{
    private $box;

    public function __construct(BoxService $box)
    {
        $this->box = $box;
    }

    public function index()
    {
        //
    }

    public function create(BoxStoreRequest $request) : object
    {
        $validated = $request->validated();

        // dd('her');
        return $this->sendJson(
            $this->box->create($request)->toArray(),
            "Box created",
            201
        );
    }

}
