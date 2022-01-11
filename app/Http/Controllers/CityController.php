<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityCategory;
use Illuminate\Http\Request;
use DataTables;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = City::all();
        $cityCategories=CityCategory::all();
        //dd($cities);
        return view('cities.index', ['cities'=>$cities, 'cityCategories'=>$cityCategories]);
    }
    // index ajax
    public function ajax(){
        $cities =City::all();
        return DataTables::of($cities)->addIndexColumn()->editColumn('category_id', function($city){
            return $city->category->region;
        })->addColumn('allowance1', function($city){
            return $city->category->allowance1;
        })->addColumn('allowance2', function($city){
            return $city->category->allowance2;
        })->addColumn('allowance3', function($city){
            return $city->category->allowance3;
        })->addColumn('action', function($city){
            return '<a href="javascript:void(0)" onclick="editCity('. $city->id.')"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" onclick="removeCity('. $city->id .')"><i class="fas fa-times-circle" style="color: rgb(233, 49, 104);"></i></a>';
             
        })->rawColumns(['allowance1', 'allowance2', 'allowance3', 'action'])
        ->make();
        //dd($cities);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd("Hello");
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
        $city=City::create(['name'=>$request->name, 'category_id'=>$request->category_id]);
        return response()->json(['success'=>true, 'city'=>$city]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
        return response()->json(['city'=>$city]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
        $city->name=$request->name;
        $city->category_id=$request->category_id;
        $city->save();
        return response()->json(['success'=>true, 'city'=>$city]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
        $city->delete();
        return response()->json(['success'=>true]);
    }
    //
}
