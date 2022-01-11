<?php

namespace App\Http\Controllers;

use App\Models\TravelAllowance;
use App\Models\Allowance;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TravelAllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Allowance $allowance)
    {
        //
        $travelAllowances=$allowance->travelAllowances()->get();
        return view('travelallowance.index', ['travelAllowances'=> $travelAllowances,
                                              'allowance'=>$allowance,
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
        $travelallowance= TravelAllowance::create($request->only(['allowance_id', 'start_place', 'start_date', 'breakfast', 'lunch', 'dinner' ]));
        $allowance=Allowance::with(['travelAllowances','travelAllowances.startCity', 'travelAllowances.breakfastCity', 'travelAllowances.lunchCity', 'travelAllowances.dinnerCity'])->find($request->allowance_id);
        $allowance->trip_allowance=$allowance->allowance_payment;
        $allowance->save();
        $allowance->append('travels_sum');
        return response()->json(['success'=>true, 'allowance'=>$allowance]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TravelAllowance  $travelAllowance
     * @return \Illuminate\Http\Response
     */
    public function show(TravelAllowance $travelAllowance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TravelAllowance  $travelAllowance
     * @return \Illuminate\Http\Response
     */
    public function edit(TravelAllowance $travelAllowance)
    {
        //
        return response()->json(['travelallowance'=> $travelAllowance,
                                            'cities'=> City::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TravelAllowance  $travelAllowance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TravelAllowance $travelAllowance)
    {
        //
        //dd($request);
        $travelAllowance->start_place=$request->start_place;
        $travelAllowance->start_date=$request->start_date;
        $travelAllowance->breakfast=$request->breakfast;
        $travelAllowance->lunch=$request->lunch;
        $travelAllowance->dinner=$request->dinner;
        $travelAllowance->save();
        $allowance=Allowance::with(['travelAllowances','travelAllowances.startCity', 'travelAllowances.breakfastCity', 'travelAllowances.lunchCity', 'travelAllowances.dinnerCity'])->find($travelAllowance->allowance_id);
        //update allowance sum
        $allowance->trip_allowance=$allowance->allowance_payment;
        $allowance->save();
        $allowance->append('travels_sum');
        return response()->json(['success'=>true, 'allowance'=>$allowance]);
        //return response()->json(['success'=>true, 'travelAllowance'=>$travelAllowance]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TravelAllowance  $travelAllowance
     * @return \Illuminate\Http\Response
     */
    public function destroy(TravelAllowance $travelAllowance)
    {
        //
        $id=$travelAllowance->allowance_id;
        $travelAllowance->delete();
        $allowance=Allowance::with(['travelAllowances','travelAllowances.startCity', 'travelAllowances.breakfastCity', 'travelAllowances.lunchCity', 'travelAllowances.dinnerCity'])->find($id);
        //update allowance sum
        $allowance->trip_allowance=$allowance->allowance_payment;
        $allowance->save();
        $allowance->append('travels_sum');
        return response()->json(['success'=>true, 'allowance'=>$allowance]);
    }
}
