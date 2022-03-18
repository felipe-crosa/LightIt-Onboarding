<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['airlineId'] ?? false, fn($query,$airlineId)=>
            $query->whereExists(fn($query)=>
                $query->from('airline_city')
                    ->where('airline_city.airline_id',$airlineId)
                    ->whereRaw('airline_city.city_id = cities.id')
            )
        );
    }

    public function departing_flights()
    {
        return $this->hasMany(Flight::class, 'departure_id', 'id');
    }

    public function arriving_flights()
    {
        return $this->hasMany(Flight::class, 'arrival_id', 'id');
    }

    public function airlines()
    {
        return $this->belongsToMany(Airline::class, 'airline_city');
    }
}
