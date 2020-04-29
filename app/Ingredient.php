<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public const MEASURES = [
        'g',
        'kg',
        'pieces'
    ];

    protected $hidden = [
        'pivot',
        'laravel_through_key',
    ];

    protected $fillable = [
        'name',
        'measure',
        'supplier'
    ];

    public static function measures()
    {
        return constant('self::MEASURES');
    }

    public function recipe()
    {
        return $this->belongsToMany('App\Recipe')->withTimestamps();
    }

}
