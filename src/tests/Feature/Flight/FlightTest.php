<?php

namespace Tests\Feature\Flight;

use App\Enums\RoleName;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlightTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private array $flightData;
    protected function setUp(): void
    {
        parent::setUp();
        // Run seeder
        $this->seed();
        // Create Admin User
        $this->user = User::factory()->create();
        // Assign Role
        $this->user->assignRole(RoleName::SYSTEM_ADMIN);
        // Setup Flight Data for testing
        $this->flightData = [
            "flight_number" => "UB22",
            "airline_id" => Airline::first()->id,
            "departure_airport_id" => Airport::first()->id,
            "arrival_airport_id" => Airport::latest()->first()->id,
            "departure_time" => "14:30:00",
            "arrival_time" => "18:45:00",
            "flight_date" => "2025-03-20",
            "price" => 100.99,
            "allowed_kg" => 30,
            "available_seats" => 150
        ];
    }

    /**
     * Test creating new flight
     * @return void
     */
    public function test_create_new_flight(): void
    {
        $response = $this->actingAs($this->user)->post('/api/flights', $this->flightData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('flights', $this->flightData);
    }

    /**
     * Test fail when create new flight if flight already exists
     * @return void
     */
    public function test_it_fails_if_flight_already_exists()
    {
        // First Create
        $this->actingAs($this->user)->post('/api/flights', $this->flightData);
        // Should Return 400
        $response = $this->actingAs($this->user)->post('/api/flights', $this->flightData);
        $response->assertStatus(400);
        $this->assertDatabaseHas('flights', $this->flightData);
    }

    /**
     * Test Search Flight
     * @return void
     */
    public function test_search_flight()
    {
        // Create Flight
        $this->actingAs($this->user)->post('/api/flights', $this->flightData);

        // Search Flight
        $this->get("/api/flights/search?from=" . Airport::first()->country
            . "&to=" . Airport::latest()->first()->country
            . "&date=2025-03-20")
            ->assertStatus(200)
            ->assertJsonFragment(['flight_number' => 'UB22']);
    }
}
