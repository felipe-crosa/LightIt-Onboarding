<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Validation\Rule;

class FlightController extends Controller
{
    public function index()
    {
        return view('flights', [
            'flights' => $this->all(),
        ]);
    }

    public function update(Flight $flight)
    {
        $attributes = request()->validate([
            'airline_id'=>['required', Rule::exists('airlines', 'id')],
            'departure_date'=>['required', 'date'],
            'arrival_date'=>['required', 'after_or_equal:departure_date'],
            'departure_id'=>['required', Rule::exists('cities', 'id')],
            'arrival_id'=>['required', Rule::exists('cities', 'id')],

        ]);

        $flight->update($attributes);
        $flight->airline;
        $flight->arrival;
        $flight->departure;

        return response()->json($flight);
    }

    public function store()
    {
        $arguments = request()->validate([
                'airline_id'=>['required', Rule::exists('airlines', 'id')],
                'departure_date'=>['required', 'date'],
                'arrival_date'=>['required', 'date', 'after_or_equal:departure_date'],
                'departure_id'=>['required', Rule::exists('cities', 'id')],
                'arrival_id'=>['required', Rule::exists('cities', 'id'), 'different:departure_id'],
            ]);

        $flight = Flight::create($arguments);

        $flight->airline;
        $flight->arrival;
        $flight->departure;

        return response()->json($flight);
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();

        return response()->json();
    }

    public function show($id)
    {
        return response()->json(Flight::with('airline.cities', 'departure', 'arrival')->find($id));
    }

    public function all()
    {
        return response()->json(Flight::with('airline.cities', 'departure', 'arrival')->get());
    }
}
