<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{

    protected $hidden = [
        'pivot',
        'laravel_through_key',
    ];

    protected $fillable = [
        'user_id',
        'delivery_date'
    ];

    public function recipes()
    {
        return $this->hasManyThrough(
            'App\Recipe',
            'App\BoxRecipe',
            'box_id',
            'id',
            'id',
            'recipe_id'
        );
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
