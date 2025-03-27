<?php

namespace Tests\Feature\Booking;

use App\Enums\RoleName;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private array $flightData;
    private array $bookingData;

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
            "flight_date" => "2026-03-20",
            "price" => 100.99,
            "allowed_kg" => 30,
            "available_seats" => 150
        ];
        // Setup Booking Data for testing
        $this->bookingData = [
            "flight_id" => 1,
            "booked_by" => "Naing Min Khant",
            "booked_email" => "nmk@gmail.com",
            "booked_phone" => "09428482942",
            "passengers" => [
                [
                    "first_name" => "John",
                    "last_name" => "Wick",
                    "passport_number" => "MF007",
                    "email" => "jw@gmail.com",
                    "phone" => "0948834323",
                    "gender" => "male",
                    "nationality" => "Myanmar",
                    "age" => 23
                ],
                [
                    "first_name" => "David",
                    "last_name" => "Backend",
                    "passport_number" => "UK999",
                    "email" => "db@gmail.com",
                    "phone" => "09488344809",
                    "gender" => "male",
                    "nationality" => "British",
                    "age" => 45
                ]
            ]
        ];
    }

    /**
     * Test making booking as customer
     * @return void
     */
    public function test_make_booking(): void
    {
        // Create flight
        $response = $this->actingAs($this->user)->post('/api/flights', $this->flightData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('flights', $this->flightData);

        // Make Booking
        $response = $this->post('/api/bookings', $this->bookingData);
        $response->assertStatus(201);
    }
}
