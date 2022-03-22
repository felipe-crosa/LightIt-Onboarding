<?php

namespace Tests\Feature;

use App\Models\Airline;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AirlineControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_airlines()
    {
        $airlines = Airline::factory()->count(10)->create();
        $response = $this->get('/airlines');

        $response->assertSuccessful();
        $this->assertDatabaseCount('airlines', 10);
        $response->assertViewIs('airlines');
        $response->assertViewHas('cities');
        $response->assertViewHas('airlines');
    }

    public function test_modification_of_airline()
    {
        $airline = Airline::factory()->create();
        $response = $this->patchJson("/airlines/{$airline->id}", ['name'=>'LATAM', 'description'=>'des', 'cities'=>City::all()]);
        $response->assertSuccessful();
        $this->assertDatabaseCount('airlines', 1);

        $this->assertDatabaseMissing('airlines', ['name'=>$airline->name]);
        $this->assertDatabaseHas('airlines', ['name'=>'LATAM']);
    }

    public function test_modification_of_nonexisting_airline()
    {
        $response = $this->patchJson('/airlines/-1', ['name'=>'LATAM', 'description'=>'des', 'cities'=>City::all()]);
        $response->assertStatus(404);
        $this->assertDatabaseCount('airlines', 0);
    }

    public function test_modification_of_airline_with_repeated_name()
    {
        $airline1 = Airline::factory()->create();
        $airline2 = Airline::factory()->create();

        $response = $this->patchJson("/airlines/{$airline1->id}", ['name'=>$airline2->name, 'description'=>'des', 'cities'=>City::all()]);
        $response->assertStatus(422);
        $this->assertDatabaseHas('airlines', ['name'=>$airline1->name]);
    }

    public function test_modification_of_airline_with_no_name()
    {
        $airline = Airline::factory()->create();

        $response = $this->patchJson("/airlines/{$airline->id}", ['name'=>'', 'description'=>'des', 'cities'=>City::all()]);
        $response->assertStatus(422);

        $this->assertDatabaseHas('airlines', ['name'=>$airline->name]);
        $this->assertDatabaseCount('airlines', 1);
    }

    public function test_modification_of_airline_with_no_description()
    {
        $airline = Airline::factory()->create();

        $response = $this->patchJson("/airlines/{$airline->id}", ['name'=>'LATAM', 'description'=>'', 'cities'=>City::all()]);
        $response->assertStatus(422);

        $this->assertDatabaseHas('airlines', ['description'=>$airline->description]);
        $this->assertDatabaseCount('airlines', 1);
    }

    public function test_aggregation_of_airline()
    {
        $response = $this->postJson('/airlines', ['name'=>'LATAM', 'description'=>'des', 'cities'=>City::all()]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('airlines', ['name'=>'LATAM', 'description'=>'des']);
        $response->assertJson(['name'=>'LATAM', 'description'=>'des']);
    }

    public function test_aggregation_of_airline_with_existing_name()
    {
        $airline = Airline::factory()->create();
        $response = $this->postJson('/airlines', ['name'=>$airline->name, 'description'=>'des', 'cities'=>City::all()]);
        $response->assertStatus(422);
        $this->assertDatabaseCount('airlines', 1);
        $this->assertDatabaseMissing('airlines', ['description'=>'des']);
    }

    public function test_aggregation_of_airline_with_no_name()
    {
        $response = $this->postJson('/airlines', ['description'=>'des', 'cities'=>City::all()]);
        $response->assertStatus(422);
        $this->assertDatabaseCount('airlines', 0);
    }

    public function test_deleting_a_airline()
    {
        $airline = Airline::factory()->create();
        $response = $this->deleteJson("/airlines/{$airline->id}");
        $response->assertSuccessful();
        $this->assertDatabaseCount('airlines', 0);
    }

    public function test_deleting_a_nonexisitng_airline()
    {
        Airline::factory()->create();
        $response = $this->deleteJson('/airlines/-1');
        $response->assertStatus(404);
        $this->assertDatabaseCount('airlines', 1);
    }

    public function test_editing_view()
    {
        $airline = Airline::factory()->create();
        $response = $this->getJson("airlines/{$airline->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('airlines-edit');
        $response->assertViewHas('airline');
        $response->assertViewHas('cities');
    }
}
