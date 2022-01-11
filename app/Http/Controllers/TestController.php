<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Allowance;
use App\Models\City;
use DataTables;
use Carbon\Carbon;
use Session;

class TestController extends Controller
{
    //
    public function index(){
        
        return view('Test.datatable');
    }
    public function data(){
        $data= User::orderBy('id', 'desc')->get();
        return DataTables::of($data)->addIndexColumn()->addColumn('action', function($row){
            return '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
        })->rawColumns(['action'])->make(true);
    }
    public function allowance(){
        $allowances= Allowance::orderBy('created_at', 'asc')->get();
        return DataTables::of($allowances)->editColumn('user_id', function($allowance){
                return $allowance->user->full_name;
        })->editColumn('target_location', function($allowance){
            return $allowance->targetCity->name;
        })->editColumn('start_date', function($allowance){
            return Carbon::parse($allowance->start_date)->diffForHumans();
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
        })->addColumn('action', function($allowance){
            return '<a href="'. route("allowances.edit", [$allowance->id]). '"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" onclick="removeAllowance('. $allowance->id .')"><i class="fas fa-times-circle" style="color: rgb(233, 49, 104);"></i></a> <a href="/allowances/reimburse/'. $allowance->id. '"><i class="fas fa-paper-plane"></i></a>';
             
        })
        ->rawColumns(['status', 'action'])
        ->make();
    }
    public function test(){
        // return view('test.createTest', ['employees'=> Employee::all(),                                         
        //                                 'cities'=> City::all()]);
        //Session::flash()
        Session::flash('success', 'File has been uploaded successfully!');
        return view('Test.toasterTest');
    }
}
