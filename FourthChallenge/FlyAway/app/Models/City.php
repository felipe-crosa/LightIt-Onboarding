<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;


    public function airlines(){
        return $this->belongsToMany(Airline::class,'airline_city','city_id','airline_id');
    }
    
}
