<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FlightController extends Controller
{
    public function index() : View
    {
        return view('flights', [
            'flights' => $this->all(),
        ]);
    }

    public function update(Flight $flight) :JsonResponse
    {
        $attributes = request()->validate([
            'airline_id'=>['required', Rule::exists('airlines', 'id')],
            'departure_date'=>['required', 'date'],
            'arrival_date'=>['required', 'after_or_equal:departure_date'],
            'departure_id'=>['required', Rule::exists('cities', 'id')],
            'arrival_id'=>['required', Rule::exists('cities', 'id')],

        ]);

        $flight->update($attributes);

        $flight->load('airline', 'departure', 'arrival');

        return response()->json($flight);
    }

    public function store() :JsonResponse
    {
        $arguments = request()->validate([
                'airline_id'=>['required', Rule::exists('airlines', 'id')],
                'departure_date'=>['required', 'date'],
                'arrival_date'=>['required', 'date', 'after_or_equal:departure_date'],
                'departure_id'=>['required', Rule::exists('cities', 'id')],
                'arrival_id'=>['required', Rule::exists('cities', 'id'), 'different:departure_id'],
            ]);

        $flight = Flight::create($arguments);
        $flight->load('airline', 'departure', 'arrival');

        return response()->json($flight);
    }

    public function destroy(Flight $flight) :JsonResponse
    {
        $flight->delete();

        return response()->json();
    }

    public function show(Flight $flight) :JsonResponse
    {
        $flight->load('airline.cities', 'departure', 'arrival');

        return response()->json($flight);
    }

    public function all()
    {
        return response()->json(Flight::with('airline.cities', 'departure', 'arrival')->get());
    }
}
