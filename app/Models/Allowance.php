<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\travelAllowance;
use App\Models\stayAllowance;
use App\Models\City;
use App\Models\User;
use Carbon\Carbon;

class Allowance extends Model
{
    use HasFactory;
    protected $appends=['days_count'];
    protected $guarded=['id'];
    
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function travelAllowances(){
        return $this->hasMany(travelAllowance::class)->orderBy('start_date');
    }
    public function stayAllowances(){
        return $this->hasMany(stayAllowance::class)->orderBy('from_date');
    }
    public function getDaysCountAttribute(){
        if($this->reimburse == false){
            $from_date=Carbon::parse($this->start_date);
            $to_date=Carbon::parse($this->return_date);
            return ($to_date->diffInDays($from_date) + 1 );
        }
    }
    public function startCity(){
        return $this->belongsTo(City::class, 'start_location');
    }
    public function targetCity(){
        return $this->belongsTo(City::class, 'target_location');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function approvedBy(){
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function getTravelsSumAttribute(){
        $travelPayment=0;
        foreach($this->travelAllowances as $travelAllowance){
            $travelPayment += $travelAllowance->travel_total;
        }
        return round($travelPayment,2);
    }
    public function getStaysSumAttribute(){
        $stayPayment=0;
        foreach($this->stayAllowances as $stayAllowance){
            $stayPayment += $stayAllowance->stay_total;
        }
        return round($stayPayment,2);
    }
    public function getAllowancePaymentAttribute(){
        $travelPayment=$this->travels_sum;
        $stayPayment=$this->stays_sum;
        return $travelPayment + $stayPayment;
    }
}
