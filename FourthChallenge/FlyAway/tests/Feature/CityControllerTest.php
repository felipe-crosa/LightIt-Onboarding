<?php

namespace Tests\Feature;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_cities()
    {
        $cities = City::factory()->count(10)->create();
        $response = $this->get('/cities');

        $response->assertSuccessful();
        $this->assertDatabaseCount('cities', 10);
        $response->assertViewIs('cities');

        //test that view loads with cities
    }

    public function test_modification_of_city()
    {
        $city = City::factory()->create();
        $attributes = ['name'=>'Felipe'];

        $response = $this->patch("/cities/{$city->id}", $attributes);
        $response->assertSuccessful();
        $this->assertDatabaseCount('cities', 1);

        $this->assertDatabaseHas('cities', ['name'=>'Felipe', 'id'=>$city->id]);
        $this->assertDatabaseMissing('cities', ['name'=>$city->name]);
    }

    public function test_modification_of_city_with_repeated_name()
    {
        $firstCity = City::factory()->create();
        $secondCity = City::factory()->create();

        $response = $this->patchJson("/cities/{$firstCity->id}", ['name'=>$secondCity->name]);
        $response->assertStatus(422);
        $this->assertDatabaseCount('cities', 2);
    }

    public function test_modification_of_city_with_no_name()
    {
        $city = City::factory()->create();

        $response = $this->patchJson("/cities/{$city->id}", ['name'=>'']);
        $response->assertStatus(422);
        $this->assertDatabaseMissing('cities', ['name'=>'']);
    }

    public function test_modification_of_nonexisting_city()
    {
        $response = $this->patchJson('/cities/-1', ['name'=>'Pedro']);
        $response->assertStatus(404);
        $this->assertDatabaseMissing('cities', ['name'=>'']);
    }

    public function test_aggregation_of_city()
    {
        $response = $this->postJson('/cities', ['name'=>'Pedro']);
        $response->assertSuccessful();
        $this->assertDatabaseCount('cities', 1);
        $this->assertDatabaseHas('cities', ['name'=>'Pedro']);
        $response->assertJson(['name'=>'Pedro']);
    }

    public function test_aggregation_of_city_with_existing_name()
    {
        $city = City::factory()->create();
        $response = $this->postJson('/cities', ['name'=>$city->name]);

        $response->assertStatus(422);
        $this->assertDatabaseCount('cities', 1);
    }

    public function test_aggregation_of_city_with_no_name()
    {
        $response = $this->postJson('/cities', ['name'=>'']);

        $response->assertStatus(422);
        $this->assertDatabaseCount('cities', 0);
    }

    public function test_deleting_a_city()
    {
        $city = City::factory()->create();
        $response = $this->deleteJson("cities/{$city->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('cities', ['id'=>$city->id, 'name'=>$city->name]);
        $this->assertDatabaseCount('cities', 0);
    }

    public function test_deleting_a_nonexisting_city()
    {
        $response = $this->deleteJson('cities/-1');

        $response->assertStatus(404);
    }

    public function test_editing_view()
    {
        $city = City::factory()->create();
        $response = $this->getJson("cities/{$city->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('cities-edit');
        //test that view loads with city
    }
}
