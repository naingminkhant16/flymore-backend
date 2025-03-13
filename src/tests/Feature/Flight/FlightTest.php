<?php

namespace Tests\Feature\Flight;

use App\Enums\RoleName;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class FlightTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Run seeder
        $this->seed();
        // Create Admin User
        $this->user = User::factory()->create();
        // Assign Role
        $this->user->assignRole(RoleName::SYSTEM_ADMIN);
    }

    public function test_create_new_flight(): void
    {
        $data = [
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
        $response = $this->actingAs($this->user)->post('/api/flights', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('flights', $data);
    }

    public function test_it_fails_if_flight_already_exists()
    {
        $data = [
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
        // First Create
        $this->actingAs($this->user)->post('/api/flights', $data);
        // Should Return 400
        $response = $this->actingAs($this->user)->post('/api/flights', $data);
        $response->assertStatus(400);
        $this->assertDatabaseHas('flights', $data);
    }
}
