<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientStoreRequest;
use App\Repositories\Interfaces\IngredientInterface;

class IngredientController extends Controller
{

    private $ingredient;

    public function __construct(IngredientInterface $ingredient)
    {
        $this->ingredient = $ingredient;
    }

    public function index() : object
    {
        $all = $this->ingredient->paginate();
        return $this->sendJson($all->toArray(), "Ingredients list");
    }

    public function create(IngredientStoreRequest $request) : object
    {
        $validated = $request->validated();

        return $this->sendJson(
            $this->ingredient->create($request)->toArray(),
            "Ingredient created",
            201
        );
    }

}
