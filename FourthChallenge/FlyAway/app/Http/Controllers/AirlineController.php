<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AirlineController extends Controller
{
    public function index() : View
    {
        $airlines=Airline::withCount('flights')->orderBy('id', 'desc')->filter(request(['selectCity']));
        return view('airlines', [
            'airlines' => $airlines->paginate(5),
            'cities'=>City::all(),
        ]);
    }

    public function update(Airline $airline) : JsonResponse
    {
        $attributes = request()->validate([
            'name'=>['required', 'max:255', Rule::unique('airlines', 'name')->ignore($airline)],
            'description'=>'required',
        ]);

        $airline->update($attributes);
        $airline->cities()->sync(request('cities'));

        return response()->json();
    }

    public function edit(Airline $airline) : View
    {
        return view('airlines-edit', ['airline'=>$airline, 'cities'=>City::all()]);
    }

    public function store() : JsonResponse
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

    public function destroy(Airline $airline) : JsonResponse
    {
        $airline->delete();

        return response()->json();
    }

    public function all() : JsonResponse
    {
        return response()->json(Airline::with('cities')->get());
    }
}
