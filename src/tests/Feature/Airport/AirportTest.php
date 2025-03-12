<?php

namespace Tests\Feature\Airport;

use App\Enums\RoleName;
use App\Models\Airport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AirportTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        // Create Role
        Role::create(['name' => RoleName::SYSTEM_ADMIN]);
        // Create Admin User
        $this->user = User::factory()->create();
        // Assign Role
        $this->user->assignRole(RoleName::SYSTEM_ADMIN);
    }

    /**
     * test get all airports
     * @return void
     */
    public function test_get_all_airports(): void
    {
        $response = $this->actingAs($this->user)->get('/api/airports');
        $response->assertStatus(200);
    }

    /**
     * test create an airport
     * @return void
     */
    public function test_create_an_airport(): void
    {
        $airportData = [
            'name' => fake()->name(),
            'code' => fake()->unique()->lexify('???'),
            'city' => fake()->city(),
            'country' => fake()->country()
        ];
        $response = $this->actingAs($this->user)->post('/api/airports', $airportData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('airports', $airportData);
    }

    /**
     * test update an airport
     * @return void
     */
    public function test_update_an_airport(): void
    {
        $airport = Airport::create([
            'name' => fake()->name(),
            'code' => fake()->unique()->lexify('???'),
            'city' => fake()->city(),
            'country' => fake()->country()
        ]);

        $updateData = [
            'name' => fake()->name(),
            'code' => fake()->unique()->lexify('???'),
            'city' => fake()->city(),
            'country' => fake()->country()
        ];

        $response = $this->actingAs($this->user)->put("/api/airports/{$airport->id}", $updateData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('airports', $updateData);
    }
}
