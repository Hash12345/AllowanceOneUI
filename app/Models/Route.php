<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class Route extends Model
{
    use HasFactory;
    protected $fillable=['start_location', 'target_location', 'breakfast', 'lunch', 'dinner', 'route'];

    function startlocation(){
        return $this->belongsTo(City::class, 'start_location');
    }
    function targetlocation(){
        return $this->belongsTo(City::class, 'target_location');
    }
    function breakfastcity(){
        return $this->belongsTo(City::class, 'breakfast');
    }
    function lunchcity(){
        return $this->belongsTo(City::class, 'lunch');
    }
    function dinnercity(){
        return $this->belongsTo(City::class, 'dinner');
    }
}
