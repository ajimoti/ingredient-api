<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientRecipe extends Model
{

    protected $table = "ingredient_recipe";
    protected $fillable = [
        'ingredient_id',
        'recipe_id',
        'amount'
    ];

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
        'laravel_through_key',
    ];

    protected $with = [
        'ingredient',
        // 'recipe'
    ];

    public function ingredient()
    {
        return $this->belongsTo('App\Ingredient');
    }

    public function recipe()
    {
        return $this->belongsTo('App\recipe');
    }

}
