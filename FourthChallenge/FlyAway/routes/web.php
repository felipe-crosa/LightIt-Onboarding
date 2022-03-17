<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\CityController;
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

Route::get('/', function () {
    return redirect('/flights');
});
Route::get('flights/all', [\App\Http\Controllers\FlightController::class, 'all']);
Route::resource('flights', \App\Http\Controllers\FlightController::class)->except(['create', 'edit']);
Route::get('airlines/all', [\App\Http\Controllers\AirlineController::class, 'all']);

Route::get('cities/all',[\App\Http\Controllers\CityController::class,'all']);
Route::resource('cities', CityController::class)->except(['create', 'show'])->names([
    'store'=>'city.store',
    'index'=>'city.index',
]);

Route::resource('airlines', AirlineController::class)->except(['create', 'show'])->names([
    'store'=>'airline.store',
    'index'=>'airline.index',

]);
