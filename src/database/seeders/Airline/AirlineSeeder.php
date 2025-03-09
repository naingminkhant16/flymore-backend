<?php

namespace Database\Seeders\Airline;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = [
            ['name' => 'American Airlines', 'code' => 'AA', 'country' => 'United States'],
            ['name' => 'British Airways', 'code' => 'BA', 'country' => 'United Kingdom'],
            ['name' => 'Lufthansa', 'code' => 'LH', 'country' => 'Germany'],
            ['name' => 'Emirates', 'code' => 'EK', 'country' => 'United Arab Emirates'],
            ['name' => 'Qatar Airways', 'code' => 'QR', 'country' => 'Qatar'],
            ['name' => 'Singapore Airlines', 'code' => 'SQ', 'country' => 'Singapore'],
            ['name' => 'Myanmar National Airlines', 'code' => 'UB', 'country' => 'Myanmar'],
            ['name' => 'Air KBZ', 'code' => 'K7', 'country' => 'Myanmar'],
            ['name' => 'MAI (Myanmar Airways International)', 'code' => '8M', 'country' => 'Myanmar'],
            ['name' => 'Thai Airways', 'code' => 'TG', 'country' => 'Thailand'],
        ];

        DB::table('airlines')->insert($airlines);
    }
}
