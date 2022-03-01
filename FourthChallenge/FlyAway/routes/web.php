<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\CityController;
use App\Models\Airline;
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
    return view('index-flights', ['flights'=>Airline::all()]);
});

Route::resource('cities', CityController::class)->except(['create', 'show'])->names([
    'store'=>'city.store',
    'destroy'=>'city.delete'
]);

Route::resource('airlines', AirlineController::class)->except(['create', 'show']);
