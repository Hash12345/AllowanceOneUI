<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\TravelAllowance;
use App\Models\StayAllowance;
use App\Models\Employee;
use App\Models\City;
use App\Models\Route;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Session;
use DataTables;
class AllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('allowances.index', ['users'=> User::all(), 
                                        'allowances'=> Allowance::get(),
                                        'cities'=> City::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('allowances.create', ['users'=> User::all(),                                         
                                        'cities'=> City::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
        
        $validation=Validator::make($request->all(), [
            'user_id'=>'required|exists:users,id',
            'start_location'=>'required',
            'target_location'=>'required',
            'start_date'=>'required',
            'return_date'=>'required',
            'trip_reason'=>'required',
            'trip_allowance'=>'required'
        ]);
        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }
       // $allowance= Allowance::create($request->only(['employee_id', 'start_location', 'target_location', 'start_date', 'return_date', 'trip_reason', 'trip_allowance']));
       $allowance= new Allowance(['user_id'=>$request->user_id,
                                 'start_location'=>$request->start_location,
                                 'target_location'=>$request->target_location,
                                 'start_date'=>$request->start_date,
                                 'return_date'=>$request->return_date,
                                 'trip_reason'=>$request->trip_reason,
                                 'trip_allowance'=>$request->trip_allowance,
                                 'user_id'=>auth()->user()->id, 
                                 'approved_date'=> Carbon::now()]);
       
        $allowance->save();
        Session::flash('success', 'Allowance Created Successfully! Editable');
        if(auth()->user()->role == 'user'){
            return Redirect::route('home');
        }
        return Redirect::route('allowances.index');
    }
    public function store_ajax(Request $request)
    {
        //
        //dd($request);
        $validation=Validator::make($request->all(), [
            'user_id'=>'required|exists:users,id',
            'start_location'=>'required',
            'target_location'=>'required',
            'start_date'=>'required',
            'return_date'=>'required',
            'trip_reason'=>'required',
            'trip_allowance'=>'required'
        ]);
        if($validation->fails() == true){
            return response()->json(['success'=> false, 'errors'=> $validation->getMessageBag()]);
        }
        $allowance= Allowance::create($request->only(['user_id', 'start_location', 'target_location', 'start_date', 'return_date', 'trip_reason', 'trip_allowance' ]));
        return response()->json(['success'=>true, 'allowance'=>$allowance]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function show(Allowance $allowance)
    {
        //        
        //$allowance=Allowance::findOrFail()
        //dd($allowance->start_city);
        return view('allowances.show', ['allowance'=>$allowance]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function edit(Allowance $allowance)
    {
        //
        return view('Allowances.edit', ['employees'=> Employee::all(),                                         
                                        'cities'=> City::all(),
                                        'allowance'=>$allowance]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allowance $allowance)
    {
        //
        $validation=Validator::make($request->all(), [
            'user_id'=>'required|exists:users,id',
            'start_location'=>'required',
            'target_location'=>'required',
            'start_date'=>'required',
            'return_date'=>'required',
            'trip_reason'=>'required',
            'trip_allowance'=>'required'
        ]);
        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }
        $allowance->user_id= $request->user_id;
        $allowance->start_location=$request->start_location;
        $allowance->target_location=$request->target_location;
        $allowance->start_date=$request->start_date;
        $allowance->return_date=$request->return_date;
        $allowance->trip_reason=$request->trip_reason;
        $allowance->trip_allowance=$request->trip_allowance;
        $allowance->save();
        return Redirect::route('allowances.index')->with('success', 'Allowance Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allowance $allowance)
    {
        //
        $id=$allowance->id;
        $allowance->delete();
        //$allowance=Allowance::with(['stayAllowances','stayAllowances.locationName'])->find($id);
        //$allowance->append('stays_sum');
        return response()->json(['success'=>true, 'id'=>$id]);
    }

    public function reimburse(Allowance $allowance){
        //create reimbursment form here
        $route1=Route::where('start_location', $allowance->start_location)
                       ->where('target_location', $allowance->target_location)
                       ->where('route',0)->first();
        $route2=Route::where('start_location', $allowance->start_location)
                       ->where('target_location', $allowance->target_location)
                       ->where('route',1)->first();
       
        // Check for route existence
        if($route1 && $route2 ){
            if($allowance->travelAllowances->count() == 0){
                //start trip travel allownace 
                TravelAllowance::create(['allowance_id'=>$allowance->id,
                                'start_place'=> $allowance->start_location,
                                'start_date'=>$allowance->start_date,
                                'breakfast'=>$route1->breakfast,
                                'lunch'=>$route1->lunch,
                                'dinner'=>$route1->dinner]);
                //return trip travel allownace 
                TravelAllowance::create(['allowance_id'=>$allowance->id,
                                    'start_place'=> $allowance->target_location,
                                    'start_date'=>$allowance->return_date,
                                    'breakfast'=>$route2->breakfast,
                                    'lunch'=>$route2->lunch]);
            }
            if($allowance->stayAllowances->count() == 0){
                //stay allowance first stay location 
                StayAllowance::create(['allowance_id'=>$allowance->id,
                    'from_date'=> $allowance->start_date,
                    'location'=>$allowance->target_location]);
                //return trip travel allownace 
                StayAllowance::create(['allowance_id'=>$allowance->id,
                    'from_date'=> Carbon::parse($allowance->start_date)->addDay(),
                    'to_date'=> Carbon::parse($allowance->return_date)->subDay(),
                    'location'=>$allowance->target_location]);
            } 
        }
        $allowance->trip_allowance=$allowance->allowance_payment;
        $allowance->save();
        $allowance->refresh();         
        return view('allowances.reimburse', ["allowance"=>$allowance]);
    }
    //get city allowance value
    public function get_city_allowance_ajax(Request $request){
        $employee=User::find($request->user_id);
        $city=City::find($request->location);
        $allowance=0;
        if($employee->salary <= 3933){
            $allowance= $city->category->allowance1;
        }
        else if($employee->salary >= 3934 && $employee->salary <= 9055){
            $allowance= $city->category->allowance2;
        }
        else{
            $allowance= $city->category->allowance3;
        }
        return response()->json(['success'=>true, 'allowance'=>$allowance]);
    }

    //generate pdf
    public function generatePDF(){
        $pdf =PDF::loadView('allowances.abc');
        //$pdf=PDF::loadHTML('<h1>ሃሰን</h>');
        return $pdf->stream('abc.pdf');
    }
    //allowance index ajax
    public function index_ajax(){
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
            })->addColumn('action', function($allowance){
                return '<a href="'. route("allowances.edit", [$allowance->id]). '"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" onclick="removeAllowance('. $allowance->id .')"><i class="fas fa-times-circle" style="color: rgb(233, 49, 104);"></i></a> <a href="/allowances/reimburse/'. $allowance->id. '"><i class="fas fa-paper-plane"></i></a>';
                
            })
            ->rawColumns(['status', 'action'])
            ->make();
    }
    //reimbursed allowance  ajax
    public function re(){
        //return "Hello";
        $allowances= Allowance::where('reimbursed', 1)->orderBy('created_at', 'asc')->get();
        return DataTables::of($allowances)->editColumn('user_id', function($allowance){
                return $allowance->user->full_name;
        })->editColumn('target_location', function($allowance){
            return $allowance->targetCity->name;
        })->editColumn('return_date', function($allowance){
            return Carbon::parse($allowance->return_date)->diffForHumans();
        })->addColumn('status', function($allowance){
            //$from_date=Carbon::parse($this->start_date);
            return "<span class='badge badge-success'>የተወራረደ</span>";
        })->addColumn('action', function($allowance){
            return '<a href="'. route("allowances.edit", [$allowance->id]). '"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" onclick="removeAllowance('. $allowance->id .')"><i class="fas fa-times-circle" style="color: rgb(233, 49, 104);"></i></a> <a href="/allowances/reimburse/'. $allowance->id. '"><i class="fas fa-paper-plane"></i></a>';
             
        })
        ->rawColumns(['status', 'action'])
        ->make();
    }

    //suspense allowance  ajax
    public function se(){
        //return "Hello";
        $allowances= Allowance::where('reimbursed', 0)->orderBy('created_at', 'asc')->get();
        return DataTables::of($allowances)->editColumn('user_id', function($allowance){
                return $allowance->user->full_name;
        })->editColumn('target_location', function($allowance){
            return $allowance->targetCity->name;
        })->editColumn('return_date', function($allowance){
            return Carbon::parse($allowance->return_date)->diffForHumans();
        })->addColumn('status', function($allowance){
            //$from_date=Carbon::parse($this->start_date);
            return "<span class='badge badge-warning'>ያልተወራረደ</span>";
        })->addColumn('action', function($allowance){
            return '<a href="'. route("allowances.edit", [$allowance->id]). '"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" onclick="removeAllowance('. $allowance->id .')"><i class="fas fa-times-circle" style="color: rgb(233, 49, 104);"></i></a> <a href="/allowances/reimburse/'. $allowance->id. '"><i class="fas fa-paper-plane"></i></a>';
             
        })
        ->rawColumns(['status', 'action'])
        ->make();
    }

    //Accept Allowance

    public function acceptAllowance(Request $request){
        // Approve User allowance
        if(auth()->user()->role == 'head'){
            $allowance = Allowance::findOrFail($request->id);
            $allowance->status=2;
            $allowance->approved_by=auth()->user()->id;
            $allowance->approved_date=Carbon::now();
            $allowance->message=$request->message;
            //$allowance->reimbursed=1;
            $allowance->save(); 
            $pending= Allowance::where('status', 0)->count();
            $accepted=Allowance::where('status', 2)->where('approved_by', auth()->user()->id)->count();
            $rejected=Allowance::where('status', 1)->where('approved_by', auth()->user()->id)->count();
            return response()->json(['success'=>true, 'allowance'=>$allowance, 'pending'=>$pending, 'accepted'=>$accepted, 'rejected'=>$rejected]);
        }   
    }
    public function rejectAllowance(Request $request){
        //reject user allowance
        if(auth()->user()->role == 'head'){
            $allowance = Allowance::findOrFail($request->id);
            $allowance->status=1;
            $allowance->approved_by=auth()->user()->id;
            $allowance->approved_date=Carbon::now();
            $allowance->message=$request->message;
            $allowance->save(); 
            $pending= Allowance::where('status', 0)->count();
            $accepted=Allowance::where('status', 2)->where('approved_by', auth()->user()->id)->count();
            $rejected=Allowance::where('status', 1)->where('approved_by', auth()->user()->id)->count();
            return response()->json(['success'=>true, 'allowance'=>$allowance, 'pending'=>$pending, 'accepted'=>$accepted, 'rejected'=>$rejected]);       
        }
    }
    //approve allowance by finance_officer
    public function approveAllowanceFinance(Request $request){
        if(auth()->user()->role == 'finance'){
            $allowance = Allowance::findOrFail($request->id);
            $allowance->payment_status=2;
            $allowance->paid_by=auth()->user()->id;
            $allowance->payment_date=Carbon::now();
            $allowance->finance_message=$request->message;
            $allowance->reimbursed=1;
            $allowance->save(); 
            $su= Allowance::where('reimbursed', 0)->get();
            $re= Allowance::where('reimbursed', 1)->get();
            $suspense_sum=0;
            $reimbursed_sum=0;
            foreach($su as $a){
                $suspense_sum += $a->trip_allowance;
            }
            foreach($re as $a){
                $reimbursed_sum += $a->trip_allowance;
            }

            return response()->json(['success'=>true, 'allowance'=>$allowance, 'suspense_sum'=>$suspense_sum, 'reimbursed_sum'=>$reimbursed_sum]);
        }
    }
    //reject allowance by finance_officer
    public function rejectAllowanceFinance(Request $request){
        if(auth()->user()->role == 'finance'){
            $allowance = Allowance::findOrFail($request->id);
            $allowance->payment_status=1;
            $allowance->paid_by=auth()->user()->id;
            $allowance->payment_date=Carbon::now();
            $allowance->finance_message=$request->message;
            $allowance->save(); 
            $su= Allowance::where('reimbursed', 0)->get();
            $re= Allowance::where('reimbursed', 1)->get();
            $suspense_sum=0;
            $reimbursed_sum=0;
            foreach($su as $a){
                $suspense_sum += $a->trip_allowance;
            }
            foreach($re as $a){
                $reimbursed_sum += $a->trip_allowance;
            }
            return response()->json(['success'=>true, 'allowance'=>$allowance, 'suspense_sum'=>$suspense_sum, 'reimbursed_sum'=>$reimbursed_sum]);
        }
    }
}
