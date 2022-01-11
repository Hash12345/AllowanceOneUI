<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Allowance;
use App\Models\City;

class TravelAllowance extends Model
{
    use HasFactory;
    public $guarded=[];
    public $appends=['travel_total'];
    public function allowance(){
        return $this->belongsTo(Allowance::class);
    }
    public function breakfastCity(){
        return $this->belongsTo(City::class, 'breakfast');
    }
    public function lunchCity(){
        return $this->belongsTo(City::class, 'lunch');
    }
    public function dinnerCity(){
        return $this->belongsTo(City::class, 'dinner');
    }
    public function startCity(){
        return $this->belongsTo(City::class, 'start_place');
    }
    public function getTravelTotalAttribute(){
        $employee_salary=$this->allowance->user->salary;
        $dinner=0;
        
        if($employee_salary <= 3933){
            $break= $this->breakfastCity->category->allowance1 * 0.1;
            $lunch=$this->lunchCity->category->allowance1 * 0.25;
            if($this->dinner){
                $dinner=$this->dinnerCity->category->allowance1 * 0.25;
            }
        }
        elseif (($employee_salary >= 3934 ) && ($employee_salary <= 9055 )) {
            $break= $this->breakfastCity->category->allowance2 * 0.1;
            $lunch=$this->lunchCity->category->allowance2 * 0.25;
            if($this->dinner){
                $dinner=$this->dinnerCity->category->allowance2 * 0.25;
            }
            
        }
        else{
            $break= $this->breakfastCity->category->allowance3 * 0.1;
            $lunch=$this->lunchCity->category->allowance3 * 0.25;
            if($this->dinner){
                $dinner=$this->dinnerCity->category->allowance3 * 0.25;
            }

        }        
        $total=$break + $lunch + $dinner;
        return $total;
    }
}
