<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityCategory extends Model
{
    use HasFactory;
    protected $fillable=['name', 'region', 'allowance1', 'allowance2', 'allowance3'];
}
