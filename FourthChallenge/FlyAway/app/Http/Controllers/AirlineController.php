<?php

namespace App\Http\Controllers;


use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function index()
    {
        return view('airline.index', [
            'airlines' => Airline::latest()->filter(
                        request(['cantidad_vuelos', 'city'])
                    )->withQueryString()
        ]);
    }

    public function show(Airline $airline)
    {
        return view('airline.show', [
            'airline' => $airline
        ]);
    }

    
}   
