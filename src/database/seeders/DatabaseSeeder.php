<?php

namespace Database\Seeders;

use Database\Seeders\Airline\AirlineSeeder;
use Database\Seeders\Airport\AirportSeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            AirlineSeeder::class,
            AirportSeeder::class,
        ]);
    }
}
