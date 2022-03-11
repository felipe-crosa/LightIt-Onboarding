<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\CityController;
use App\Models\Flight;
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

Route::get('/flights', function () {
    return view('flights', ['flights'=>Flight::with('arrival', 'departure', 'airline')->get()]);
});

Route::resource('cities', CityController::class)->except(['create', 'show'])->names([
    'store'=>'city.store',
    'index'=>'city.index',
]);

Route::resource('airlines', AirlineController::class)->except(['create', 'show'])->names([
    'store'=>'airline.store',
    'index'=>'airline.index',

]);
