<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\StayAllowance;
use App\Models\City;
use Illuminate\Http\Request;

class StayAllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Allowance $allowance)
    {
        //
        $stayAllowances=$allowance->stayAllowances()->orderBy('from_date', 'asc')->get();
        return view('stayallowance.index', 
            ['stayAllowances'=> $stayAllowances,
            'allowance'=> $allowance,
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request);
        $stayallowance= StayAllowance::create($request->only(['allowance_id', 'location', 'from_date', 'to_date']));
        $allowance=Allowance::with(['stayAllowances','stayAllowances.locationName'])->find($request->allowance_id);
        //update allowance sum
        $allowance->trip_allowance=$allowance->allowance_payment;
        $allowance->save();
        $allowance->append('stays_sum');
        return response()->json(['success'=>true, 'allowance'=>$allowance]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StayAllowance  $stayAllowance
     * @return \Illuminate\Http\Response
     */
    public function show(StayAllowance $stayAllowance)
    {
        //
        return response()->json(['stayallowance'=> $stayAllowance]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StayAllowance  $stayAllowance
     * @return \Illuminate\Http\Response
     */
    public function edit(StayAllowance $stayAllowance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StayAllowance  $stayAllowance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StayAllowance $stayAllowance)
    {
        //
        $stayAllowance->from_date=$request->from_date;
        $stayAllowance->to_date=$request->to_date;
        $stayAllowance->location=$request->location;
        $stayAllowance->save();
        $allowance=Allowance::with(['stayAllowances','stayAllowances.locationName'])->find($request->allowance_id);
        //update allowance sum
        $allowance->trip_allowance=$allowance->allowance_payment;
        $allowance->save();
        $allowance->append('stays_sum');
        return response()->json(['success'=>true, 'allowance'=>$allowance]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StayAllowance  $stayAllowance
     * @return \Illuminate\Http\Response
     */
    public function destroy(StayAllowance $stayAllowance)
    {
        //
        $id=$stayAllowance->allowance_id;
        $stayAllowance->delete();
        $allowance=Allowance::with(['stayAllowances','stayAllowances.locationName'])->find($id);
        //update allowance sum
        $allowance->trip_allowance=$allowance->allowance_payment;
        $allowance->save();
        $allowance->append('stays_sum');
        return response()->json(['success'=>true, 'allowance'=>$allowance]);
    }
}
