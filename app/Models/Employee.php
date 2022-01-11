<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable=['employee_id', 'first_name', 'middle_name', 'last_name', 'department_id', 'job_title' , 'salary', 'email'];
    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->middle_name. " " . $this->last_name;
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
}
