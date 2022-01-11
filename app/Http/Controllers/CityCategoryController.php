<?php

namespace App\Http\Controllers;

use App\Models\CityCategory;
use Illuminate\Http\Request;
use DataTables;

class CityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('cityCategories.index');
    }
    public function index_ajax(){
        $categories=CityCategory::all();
        return DataTables::of($categories)->addIndexColumn()
        ->addColumn('action', function($category){
            return '<a href="javascript:void(0)" onclick="editCityCategory('. $category->id.')"><i class="fas fa-pencil-alt"></i></a> <a href="javascript:void(0)" onclick="removeCityCategory('. $category->id .')"><i class="fas fa-times-circle" style="color: rgb(233, 49, 104);"></i></a>';
             
        })->rawColumns(['action'])
        ->make();

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
        $category=CityCategory::create(['name'=>$request->name, 'region'=>$request->region, 'allowance1'=>$request->allowance1, 'allowance2'=>$request->allowance2, 'allowance3'=>$request->allowance3]);
        return response()->json(['success'=>true, 'category'=>$category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CityCategory  $cityCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CityCategory $category)
    {
        //
        return response()->json(['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CityCategory  $cityCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CityCategory $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CityCategory  $cityCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CityCategory $category)
    {
        //
        $category->name=$request->name;
        $category->region=$request->region;
        $category->allowance1=$request->allowance1;
        $category->allowance2=$request->allowance2;
        $category->allowance3=$request->allowance3;
        $category->save();
        return response()->json(['success'=>true, 'category'=>$category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CityCategory  $cityCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CityCategory $category)
    {
        //
        $category->delete();
        return response()->json(['success'=>true]);
    }
}
