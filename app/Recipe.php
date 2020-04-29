<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    protected $fillable = [
        'name',
        'description'
    ];

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at',
        'laravel_through_key',
    ];

    protected $with = [
        'ingredients'
    ];

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient')->withPivot('amount')->withTimestamps();
    }

    public function box()
    {
        return $this->belongsTo('App\Box');
    }

}
