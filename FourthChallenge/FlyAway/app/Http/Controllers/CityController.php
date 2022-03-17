<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CityController extends Controller
{
    public function index() : View
    {
        $sortBy='id';
        if(request('sortCriteria')){
            $sortBy=request('sortCriteria');
        }

        return view('cities', [

            'cities' => City::withCount('arriving_flights', 'departing_flights')->orderBy($sortBy, 'desc')->paginate(5),
            'sortCriteria'=>$sortBy
        ]);
    }

    public function update(City $city) : JsonResponse
    {
        $attributes = request()->validate([
            'name'=>['regex:/^[\pL\s\-]+$/u', 'required', 'max:255', Rule::unique('cities', 'name')->ignore($city)],
        ]);

        $city->update($attributes);

        return response()->json($city);
    }

    public function edit(City $city) :View
    {
        return view('cities-edit', ['city'=>$city]);
    }

    public function store() :JsonResponse
    {
        $arguments = request()->validate([
            'name'=>'required|regex:/^[\pL\s\-]+$/u|unique:cities,name|max:255',
        ]);

        $city = City::create($arguments);

        return response()->json($city);
    }

    public function destroy(City $city) : JsonResponse
    {
        $city->delete();

        return response()->json();
    }
//
//    public function all() : JsonResponse
//    {
//        $sortCriteria=request('sortBy');
//        return response()->json(City::orderBy($sortCriteria)->get());
//    }
}
