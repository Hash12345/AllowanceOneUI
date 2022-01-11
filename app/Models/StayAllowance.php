<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Allowance;
use Carbon\Carbon;

class StayAllowance extends Model
{
    use HasFactory;
    protected $fillable=['from_date', 'to_date', 'location', 'allowance_id'];
    protected $casts=[
        'from_date'=>'date:Y-m-d',
        'to_date'=>'date:Y-m-d'
    ];
    protected $appends=['stay_total', 'days_count'];
    public function locationName(){
        return $this->belongsTo(City::class, 'location');
    }
    public function allowance(){
        return $this->belongsTo(Allowance::class);
    }
    public function city(){
        return $this->belongsTo(City::class,"location");
    }
    public function getStayTotalAttribute(){
        $total=0;
        $employee_salary=$this->allowance->user->salary;
        $days=$this->days_count;
        if($days==1){
            if($employee_salary <= 3933){
                return $this->city->category->allowance1 * 0.4;
            }
            elseif (($employee_salary >= 3934 ) && ($employee_salary <= 9055 )) {
                return $this->city->category->allowance2 * 0.4;
            }
            else{
                return $this->city->category->allowance3 * 0.4;
            } 
        }
        else{
            if($employee_salary <= 3933){
                return $this->city->category->allowance1 * $days;
            }
            elseif (($employee_salary >= 3934 ) && ($employee_salary <= 9055 )) {
                return $this->city->category->allowance2 * $days;
            }
            else{
                return $this->city->category->allowance3 * $days;
            } 
        }
        
        //return $this->belongsTo(City::class, 'dinner');
        return $total;
    }
    public function getDaysCountAttribute(){
        if(!$this->to_date){
            return 1;
        }
        $from_date=Carbon::parse($this->from_date);
        $to_date=Carbon::parse($this->to_date);
        return ($to_date->diffInDays($from_date) + 1 );
    }
    
}
