<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\Models\Allowance;
use App\Models\City;

class DashboardController extends Controller
{
    //
    public function index(){
        return view('dashboard');
    }
    public function allowances(){
        //return "Hello";
        $allowances= Allowance::orderBy('created_at', 'asc')->get();
        return DataTables::of($allowances)->editColumn('user_id', function($allowance){
                return $allowance->user->full_name;
        })->editColumn('target_location', function($allowance){
            return $allowance->targetCity->name;
        })->editColumn('return_date', function($allowance){
            return Carbon::parse($allowance->return_date)->diffForHumans();
        })->addColumn('status', function($allowance){
            //$from_date=Carbon::parse($this->start_date);
            $to_date=Carbon::parse($allowance->return_date);
            
            if($allowance->reimbursed == 1){
                return "<span class='badge badge-success'>የተወራረደ</span>";
            }
            else{
                if($to_date->lt(Carbon::now())){
                    if($to_date->diffInDays(Carbon::now()) + 1 > 7){
                        return "<span class='badge badge-danger'>ጊዜዉ ያልፈ</span>";
                    }
                    else{
                        return "<span class='badge badge-warning'>ያልተወራረደ</span>";
                    }
                }
                else {
                    return "<span class='badge badge-info'>በስራ ላይ</span>";
                }
            }
        })->rawColumns(['status'])
        ->make();
    }
    public function city(){
        $cities =City::all();
        return DataTables::of($cities)->addIndexColumn()->editColumn('category_id', function($city){
            return $city->category->region;
        })->addColumn('allowance1', function($city){
            return $city->category->allowance1;
        })->addColumn('allowance2', function($city){
            return $city->category->allowance2;
        })->addColumn('allowance3', function($city){
            return $city->category->allowance3;
        })->rawColumns(['allowance1', 'allowance2', 'allowance3'])
        ->make();
    }
}
