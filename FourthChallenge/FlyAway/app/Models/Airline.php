<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;


    public function cities(){
        return $this->belongsToMany(City::class,'airline_city','airline_id','city_id');
    }
    
    public function flights(){
        return $this->hasMany(Flight::class);
    }


}


