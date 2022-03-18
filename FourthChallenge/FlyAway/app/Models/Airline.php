<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Airline extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query,array $filters){

        $query->when(
            $filters['selectCity'] ?? false,
            fn($query, $selectCity) => $query->whereExists(
                fn($query)=>$query->from('airline_city')
                ->where('city_id', $selectCity)
                ->whereRaw('airline_city.airline_id = airlines.id')
            )
        );
    }

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'airline_city');
    }
}
