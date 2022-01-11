<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CityCategory;

class City extends Model
{
    use HasFactory;
    public $fillable=['name', 'category_id'];
    public function category(){
        return $this->belongsTo(CityCategory::class, "category_id");
    }
}
