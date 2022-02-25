<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    public function index()
    {
        return view('cities', [
            'cities' => City::orderBy('id')->paginate(5)
        ]);
    }




    public function update(City $city)
    {
    //validate city 
        $attributes= request()->validate([
            'name'=>['required','max:255',Rule::unique('cities','name')->ignore($city)]
        ]);
    //Update it
        $city->update($attributes);
        return back()->with('success', 'City Updated!');
    }


    public function edit(City $city){
        return view('cities-edit',['city'=>$city]);
    }

    public function store(){
        $arguments=request()->validate([
            'name'=>'required|regex:/^[\pL\s\-]+$/u|unique:cities,name|max:255'
        ]);

        City::create($arguments);

        return back()->with('success', 'City Added!')->withInput(['name']);
    }

    public function destroy(City $city){
        $city->delete();

        return back()->with('success','City deleted!');
    }
    

}
