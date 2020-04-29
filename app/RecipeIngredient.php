<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{

    protected $fillable = [
        'ingredient_id',
        'recipe_id',
        'amount'
    ];

    protected $hidden = [
        'pivot',
        'laravel_through_key',
    ];

    public function ingredient()
    {
        return $this->belongsTo('App\Ingredient');
    }

    public function recipe()
    {
        return $this->belongsTo('App\recipe');
    }

    public function recipeIngredients()
    {
        return $this->belongsTo('App\RecipeIngredient');
    }

}
