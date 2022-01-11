<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $routes=Route::all();
        $cities=City::all();
        return view('routes.index', ['routes'=>$routes, 'cities'=>$cities]);
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
        $route=Route::create(['start_location'=>$request->start_location, 'target_location'=>$request->target_location,'breakfast'=>$request->breakfast, 'lunch'=>$request->lunch,'dinner'=>$request->dinner, 'route'=>$request->route]);
        return response()->json(['success'=>true, 'route'=>$route]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
        //dd($route);
        return response()->json(['route'=>$route]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {
        //
        $route->route=$request->route;
        $route->start_location=$request->start_location;
        $route->target_location=$request->target_location;
        $route->breakfast=$request->breakfast;
        $route->lunch=$request->lunch;
        $route->dinner=$request->dinner;
        $route->save();
        return response()->json(['success'=>true, 'route'=>$route]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        //
        $route->delete();
        return response()->json(['success'=>true]);
    }
}
