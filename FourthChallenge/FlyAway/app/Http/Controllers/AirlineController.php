<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\City;
use Illuminate\Validation\Rule;

class AirlineController extends Controller
{
    public function index()
    {
        return view('airlines', [
            'airlines' => Airline::orderBy('id')->paginate(5),
            'cities'=>City::all(),
        ]);
    }

    public function update(Airline $airline)
    {
        $attributes = request()->validate([
            'name'=>['required', 'max:255', Rule::unique('airlines', 'name')->ignore($airline)],
            'description'=>'required',
        ]);

        $airline->update($attributes);
        $airline->cities()->sync(request('cities'));

        return response()->json();
    }

    public function edit(Airline $airline)
    {
        return view('airlines-edit', ['airline'=>$airline, 'cities'=>City::all()]);
    }

    public function store()
    {
        $arguments = request()->validate([
            'name'=>'required|unique:airlines,name|max:255',
            'description'=>'required',
        ]);
        $cities = request('cities');

        $airline = Airline::create($arguments);
        $airline->cities()->sync($cities);

        return response()->json($airline);
    }

    public function destroy(Airline $airline)
    {
        $airline->delete();

        return response()->json();
    }

    public function all()
    {
        return response()->json(Airline::with('cities')->get());
    }
}
