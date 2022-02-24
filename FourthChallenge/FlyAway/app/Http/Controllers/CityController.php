<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return view('city', [
            'cities' => City::latest()->get()
        ]);
    }




    public function update(City $city)
    {
    //validate city 
        $attributes= request()->validate([
            'name'=>'required'
        ]);
    //Update it
        $city->update($attributes);
        return back()->with('success', 'Post Updated!');
    }

    
    

}
