<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Validation\Rule;

class AirlineController extends Controller
{
    public function index()
    {
        return view('airlines', [
            'airlines' => Airline::orderBy('id')->paginate(5),
        ]);
    }

    public function update(Airline $airline)
    {
        $attributes = request()->validate([
            'name'=>['required', 'max:255', Rule::unique('airlines', 'name')->ignore($airline)],
            'description'=>'required',
        ]);

        $airline->update($attributes);

        return response()->json();
    }

    public function edit(Airline $airline)
    {
        return view('airlines-edit', ['airline'=>$airline]);
    }

    public function store()
    {
        $arguments = request()->validate([
            'name'=>'required|unique:airlines,name|max:255',
            'description'=>'required',
        ]);

        $airline= Airline::create($arguments);

        return response()->json($airline);
    }

    public function destroy(Airline $airline)
    {
        $airline->delete();

        return response()->json();
    }
}
