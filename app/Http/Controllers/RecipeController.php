<?php

namespace App\Http\Controllers;

use App\Services\RecipeService;
use App\Http\Requests\RecipeStoreRequest;

class RecipeController extends Controller
{
    private $recipe;

    public function __construct(RecipeService $recipe)
    {
        $this->recipe = $recipe;
    }

    public function index() : object
    {
        $recipes = $this->recipe->paginate();

        return $this->sendJson($recipes->toArray(), "recipes list");
    }

    public function create(RecipeStoreRequest $request) : object
    {
        $validated = $request->validated();

        return $this->sendJson(
            $this->recipe->create($request)->toArray(),
            "recipe created",
            201
        );
    }

}
