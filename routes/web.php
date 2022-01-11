<?php

use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\TravelAllowanceController;
use App\Http\Controllers\StayAllowanceController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CityCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

//Main URL
Route::get('/', function(){
    return redirect('/home');
});
// Home
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/home/user-home-ajax', [HomeController::class, 'user_home_ajax'])->name('home.user')->middleware('auth');
Route::get('/home/head-home-ajax', [HomeController::class, 'head_home_ajax'])->name('home.head')->middleware('auth');
Route::get('/home/finance-home-ajax', [HomeController::class, 'finance_home_ajax'])->name('home.finance')->middleware('auth');
Route::get('/home/head-home-rejected-ajax', [HomeController::class, 'head_home_rejected_ajax'])->name('home.rejected.head')->middleware('auth');
Route::get('/home/head-home-accepted-ajax', [HomeController::class, 'head_home_accepted_ajax'])->name('home.accepted.head')->middleware('auth');
Route::get('/home/user-home-rejected-ajax', [HomeController::class, 'user_home_rejected_ajax'])->name('home.rejected.user')->middleware('auth');
Route::get('/home/user-home-accepted-ajax', [HomeController::class, 'user_home_accepted_ajax'])->name('home.accepted.user')->middleware('auth');



Route::get('/all', [DashboardController::class, 'allowances'])->name('allo');
Route::get('/city', [DashboardController::class, 'city'])->name('city');

Route::get('/generatePDF', [AllowanceController::class, 'generatePDF'])->name('generatePDF');
Route::resource('/routes', RouteController::class);
Route::resource('/allowances', AllowanceController::class)->middleware('auth');
//approve and reject allowance
Route::post('/allowance/approve', [AllowanceController::class, 'acceptAllowance'])->name('allowance.approve')->middleware('auth');
Route::post('/allowance/reject', [AllowanceController::class, 'rejectAllowance'])->name('allowance.reject')->middleware('auth');

//approve and reject allowance by finance
Route::post('/allowance/approve-finance', [AllowanceController::class, 'approveAllowanceFinance'])->name('allowance.approve.payment')->middleware('auth');
Route::post('/allowance/reject-finance', [AllowanceController::class, 'rejectAllowanceFinance'])->name('allowance.reject.payment')->middleware('auth');



Route::resource('/cities', CityController::class);
Route::resource('/categories', CityCategoryController::class);
//allowance index_ajax
Route::get('/allowances/index_ajax', [AllowanceController::class, 'index_ajax'])->name('allowances.ajax');
Route::get('/cities_ajax', [CityController::class, 'ajax'])->name('cities.ajax');
Route::get('/categories_ajax', [CityCategoryController::class, 'index_ajax'])->name('categories.ajax');
Route::get('/reimbursed', [AllowanceController::class, 're'])->name('re');
Route::get('/suspense', [AllowanceController::class, 'se'])->name('se');
//allowances reimbursment form
Route::get('allowances/reimburse/{allowance}', [AllowanceController::class, "reimburse"])->name('reimburse.create');

//Travel Allowance Routes
Route::group(['prefix'=>'allowance'], function(){
    //travel allowance
    Route::get('/travel_view/{allowance}', [TravelAllowanceController::class, 'index'])->name('travelallowance.index');
    Route::post('/travel_view/', [TravelAllowanceController::class, 'store'])->name('travelallowance.store');
    Route::get('/travel_view/{travelAllowance}/show',[TravelAllowanceController::class, 'edit'])->name('travelallowance.edit');
    Route::put('/travel_view/{travelAllowance}', [TravelAllowanceController::class, 'update'])->name('travelallowance.update');
    Route::delete('/travel_view/{travelAllowance}', [TravelAllowanceController::class, 'destroy'])->name('travelallowance.destroy');

    //stay allowance
    Route::get('/stay_view/{allowance}', [StayAllowanceController::class, 'index'])->name('stayallowance.index');
    Route::post('/stay_view/', [StayAllowanceController::class, 'store'])->name('stayallowance.store');
    Route::get('/stay_view/{stayAllowance}/show',[StayAllowanceController::class, 'show'])->name('stayallowance.show');
    Route::put('/stay_view/{stayAllowance}', [StayAllowanceController::class, 'update'])->name('stayallowance.update');
    Route::delete('/stay_view/{stayAllowance}', [StayAllowanceController::class, 'destroy'])->name('stayallowance.destroy');
});

//get target location allowance value
Route::post('/allowance/get_city_allowance', [AllowanceController::class, 'get_city_allowance_ajax']);
// Route::get('/test', function(){
//     return view('test');
// });

//Test URLS
Route::get('/test', [TestController::class, 'test']);
Route::get('/test1', [TestController::class, 'index']);
Route::get('/test2', [TestController::class, 'data'])->name('data');
Route::get('/test3', [TestController::class, 'allowance'])->name('allowanceajax');
Route::get('/testpage', [TestController::class, 'test']);

