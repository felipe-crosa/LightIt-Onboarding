<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Airline;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $airline=Airline::factory();
        $departure=City::factory();
       
        $arrival=City::factory();
        $departure_date=$this->faker->dateTime();
        
        return [
            
            'airline_id'=>Airline::factory(),
            'departure_id'=>City::factory(),
            'arrival_id'=>City::factory(),
            'departure_date'=>$departure_date,
            'arrival_date'=>$this->faker->dateTimeBetween($departure_date,'+2 days')
        ];
    }
}
