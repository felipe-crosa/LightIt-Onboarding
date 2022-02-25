<?php

namespace App\Models;

use App\Models\City;
use App\Models\Airline;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use HasFactory;
    

    public function airline(){
        return $this->belongsTo(Airline::class);
    }

    public function departure(){
        return $this->hasOne(City::class,'id','departure_id');
    }

    public function arrival(){
        return $this->hasOne(City::class,'id', 'arrival_id');
    }
}
