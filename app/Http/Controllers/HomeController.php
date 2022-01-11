<?php

namespace App\Http\Controllers;
use App\Models\Allowance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;

class HomeController extends Controller
{
    //
    public function index(){
        if(auth()->user()->role == 'user'){
            $pending= Allowance::where('status', 0)->where('user_id', auth()->user()->id)->count();
            $accepted=Allowance::where('status', 2)->where('user_id', auth()->user()->id)->count();
            $rejected=Allowance::where('status', 1)->where('user_id', auth()->user()->id)->count();
            return view('home.user_home', ['pending'=>$pending, 'accepted'=>$accepted, 'rejected'=>$rejected]);
        }
        else if(auth()->user()->role == 'head'){
            $pending= Allowance::where('status', 0)->count();
            $accepted=Allowance::where('status', 2)->where('approved_by', auth()->user()->id)->count();
            $rejected=Allowance::where('status', 1)->where('approved_by', auth()->user()->id)->count();
            return view('home.head_home', ['pending'=>$pending, 'accepted'=>$accepted, 'rejected'=>$rejected]);
        }
    }
    public function user_home_ajax(){
        $allowances= Allowance::where('user_id', auth()->user()->id)->where('status', 0)->orderBy('created_at', 'asc')->get();
        return DataTables::of($allowances)->editColumn('user_id', function($allowance){
            return $allowance->user->full_name;
        })->editColumn('target_location', function($allowance){
        return $allowance->targetCity->name;
        })->editColumn('return_date', function($allowance){
        return Carbon::parse($allowance->return_date)->diffForHumans();
        })->addColumn('reimbursed', function($allowance){
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
        })->addColumn('status', function($allowance){
            if($allowance->status == 0){
                return "<span class='badge badge-warning'>Pending...</span>";                 
            }
            else if($allowance->status == 1) {
                return "<span class='badge badge-danger'>Rejected</span>";                 
            }
            else {
                return "<span class='badge badge-success'>Accepted</span>";                 
            }
        })
        ->rawColumns(['reimbursed', 'status'])
        ->make();
    }
    //allowances list accepted by department head
    public function user_home_accepted_ajax(){
        $allowances= Allowance::where('status', 2)->where('user_id', auth()->user()->id)->orderBy('created_at', 'asc')->get();
        return DataTables::of($allowances)->editColumn('user_id', function($allowance){
            return $allowance->user->full_name;
        })->editColumn('target_location', function($allowance){
        return $allowance->targetCity->name;
        })->editColumn('return_date', function($allowance){
        return Carbon::parse($allowance->return_date)->diffForHumans();
        })->addColumn('action', function($allowance){
            return '<span class="badge badge-success">Approved</span>';
        })
        ->rawColumns(['action'])
        ->make();
    }
    //allowances list rejected by department head
    public function user_home_rejected_ajax(){
        $allowances= Allowance::where('status', 1)->where('user_id', auth()->user()->id)->orderBy('created_at', 'asc')->get();
        return DataTables::of($allowances)->editColumn('user_id', function($allowance){
            return $allowance->user->full_name;
        })->editColumn('target_location', function($allowance){
        return $allowance->targetCity->name;
        })->editColumn('return_date', function($allowance){
        return Carbon::parse($allowance->return_date)->diffForHumans();
        })->addColumn('action', function($allowance){
            return '<span class="badge badge-success">Approved</span>';
        })
        ->rawColumns(['action'])
        ->make();
    }

    public function head_home_ajax(){
        $allowances= Allowance::where('status', 0)->orderBy('created_at', 'asc')->get();
        return DataTables::of($allowances)->editColumn('user_id', function($allowance){
            return $allowance->user->full_name;
        })->editColumn('target_location', function($allowance){
        return $allowance->targetCity->name;
        })->editColumn('return_date', function($allowance){
        return Carbon::parse($allowance->return_date)->diffForHumans();
        })->addColumn('action', function($allowance){
            return '<a href="javascript:void(0)" onclick="approveAllowance('. $allowance->id .')"><i class="fas fa-check text-success"></i></a> <a href="javascript:void(0)" onclick="rejectAllowance('. $allowance->id .')"><i class="fas fa-times-circle" style="color: rgb(233, 49, 104);"></i></a> <a href="'. route("allowances.show", [$allowance->id]). '"><i class="fas fa-info"></i></a>';
        })
        ->rawColumns(['action'])
        ->make();
    }
    //users list accepted by department head
    public function head_home_accepted_ajax(){
        $allowances= Allowance::where('status', 2)->where('approved_by', auth()->user()->id)->orderBy('created_at', 'asc')->get();
        return DataTables::of($allowances)->editColumn('user_id', function($allowance){
            return $allowance->user->full_name;
        })->editColumn('target_location', function($allowance){
        return $allowance->targetCity->name;
        })->editColumn('return_date', function($allowance){
        return Carbon::parse($allowance->return_date)->diffForHumans();
        })->addColumn('action', function($allowance){
            return '<span class="badge badge-success">Approved</span>';
        })
        ->rawColumns(['action'])
        ->make();
    }
    //users list Rejected by department head
    public function head_home_rejected_ajax(){
        $allowances= Allowance::where('status', 1)->where('approved_by', auth()->user()->id)->orderBy('created_at', 'asc')->get();
        return DataTables::of($allowances)->editColumn('user_id', function($allowance){
            return $allowance->user->full_name;
        })->editColumn('target_location', function($allowance){
        return $allowance->targetCity->name;
        })->editColumn('return_date', function($allowance){
        return Carbon::parse($allowance->return_date)->diffForHumans();
        })->addColumn('action', function($allowance){
            return '<span class="badge badge-danger">Rejected</span>';
        })
        ->rawColumns(['action'])
        ->make();
    }
}
