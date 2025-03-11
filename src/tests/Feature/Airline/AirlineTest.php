<?php

namespace Tests\Feature\Airline;

use App\Enums\RoleName;
use App\Models\Airline;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AirlineTest extends TestCase
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
     * Get All Airlines Test Case
     */
    public function test_get_all_airlines(): void
    {
        $response = $this->actingAs($this->user)->get('/api/airlines');
        $response->assertStatus(200);
    }

    /**
     * test creating airline
     * @return void
     */
    public function test_store_an_airline(): void
    {
        $airlineData = [
            'name' => fake()->company(),
            'code' => fake()->unique()->lexify('??'),
            'country' => fake()->country()
        ];

        $response = $this->actingAs($this->user)->postJson('/api/airlines', $airlineData);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Airline created']);

        $this->assertDatabaseHas('airlines', $airlineData);
    }

    /**
     * test updating airline
     * @return void
     */
    public function test_update_an_airline(): void
    {
        // Create Airline
        $airline = Airline::create([
            'name' => fake()->company(),
            'code' => fake()->unique()->lexify('??'),
            'country' => fake()->country()
        ]);

        $updateData = [
            'name' => fake()->company(),
            'code' => fake()->unique()->lexify('??'),
            'country' => fake()->country(),
        ];

        $response = $this->actingAs($this->user)->put("/api/airlines/$airline->id", $updateData);
        $response->assertStatus(200);
        $this->assertDatabaseHas("airlines", $updateData);
    }
}
