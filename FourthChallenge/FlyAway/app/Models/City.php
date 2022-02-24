<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        
        $query->when($filters['airline'] ?? false, fn($query, $airline) =>
            $query
        );

       
    }




    public function departing_flights(){
        return $this->hasMany(Flight::class,'departure_id','id');
    }

    public function arriving_flights(){
        return $this->hasMany(Flight::class,'arrival_id','id');
    }
    
}
