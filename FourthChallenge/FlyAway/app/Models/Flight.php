<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function departure()
    {
        return $this->hasOne(City::class, 'id', 'departure_id');
    }

    public function arrival()
    {
        return $this->hasOne(City::class, 'id', 'arrival_id');
    }
}
