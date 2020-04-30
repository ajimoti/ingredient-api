<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
        'laravel_through_key',
    ];

    protected $fillable = [
        'user_id',
        'delivery_date'
    ];

    protected $with = [
        'recipes'
    ];

    public function recipes()
    {
        return $this->hasManyThrough(
            'App\IngredientRecipe',
            'App\BoxRecipe',
            'box_id',
            'recipe_id',
            'id',
            'id'
        );
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeBetweenDeliveryDates($query, $firstDate, $secondDate)
    {
        return $query->whereBetween('delivery_date', [$firstDate, $secondDate]);
    }

    public function scopeDeliveryDate($query, $date)
    {
        return $query->where('delivery_date', $date);
    }

    public function scopeSupplier($query, $supplier)
    {
        // return $query->with(['recipes.ingredient' => function ($query) use ($supplier) {
        //     $query->whereIn('supplier', $supplier);
        // }]);

        return $query->leftJoin('box_recipes', 'boxes.id', '=', 'box_recipes.box_id')
                    ->leftJoin('ingredient_recipe', 'ingredient_recipe.recipe_id', '=', 'box_recipes.recipe_id')
                    ->leftJoin('ingredients', 'ingredients.id', '=', 'ingredient_recipe.ingredient_id')
                    ->whereIn('ingredients.supplier', $supplier);
    }

}
