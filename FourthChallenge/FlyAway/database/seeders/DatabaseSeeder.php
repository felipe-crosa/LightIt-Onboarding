<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Flight;
use App\Models\Airline;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Flight::factory(5)->create();

        $cities= City::factory(5)->create();
        $airline= Airline::factory(5)->create();
    }
}
