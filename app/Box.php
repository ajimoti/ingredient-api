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

}
