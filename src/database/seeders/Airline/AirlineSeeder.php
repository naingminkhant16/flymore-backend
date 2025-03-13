<?php

namespace Database\Seeders\Airline;

use Carbon\Carbon;
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
        $now = Carbon::now();

        $airlines = [
            ['name' => 'American Airlines', 'code' => 'AA', 'country' => 'United States', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'British Airways', 'code' => 'BA', 'country' => 'United Kingdom', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lufthansa', 'code' => 'LH', 'country' => 'Germany', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Emirates', 'code' => 'EK', 'country' => 'United Arab Emirates', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Qatar Airways', 'code' => 'QR', 'country' => 'Qatar', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Singapore Airlines', 'code' => 'SQ', 'country' => 'Singapore', 'created_at' => $now, 'updated_at' => $now],

            // Myanmar Airlines
            ['name' => 'Myanmar National Airlines', 'code' => 'UB', 'country' => 'Myanmar', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Air KBZ', 'code' => 'K7', 'country' => 'Myanmar', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MAI (Myanmar Airways International)', 'code' => '8M', 'country' => 'Myanmar', 'created_at' => $now, 'updated_at' => $now],

            ['name' => 'Thai Airways', 'code' => 'TG', 'country' => 'Thailand', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Bangkok Airways', 'code' => 'PG', 'country' => 'Thailand', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Thai AirAsia', 'code' => 'FD', 'country' => 'Thailand', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Nok Air', 'code' => 'DD', 'country' => 'Thailand', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Vietnam Airlines', 'code' => 'VN', 'country' => 'Vietnam', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Japan Airlines', 'code' => 'JL', 'country' => 'Japan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'All Nippon Airways', 'code' => 'NH', 'country' => 'Japan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Korean Air', 'code' => 'KE', 'country' => 'South Korea', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Asiana Airlines', 'code' => 'OZ', 'country' => 'South Korea', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'China Eastern Airlines', 'code' => 'MU', 'country' => 'China', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'China Southern Airlines', 'code' => 'CZ', 'country' => 'China', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Air China', 'code' => 'CA', 'country' => 'China', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'IndiGo', 'code' => '6E', 'country' => 'India', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Air India', 'code' => 'AI', 'country' => 'India', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Malaysia Airlines', 'code' => 'MH', 'country' => 'Malaysia', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Garuda Indonesia', 'code' => 'GA', 'country' => 'Indonesia', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Philippine Airlines', 'code' => 'PR', 'country' => 'Philippines', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hong Kong Airlines', 'code' => 'HX', 'country' => 'Hong Kong', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'EVA Air', 'code' => 'BR', 'country' => 'Taiwan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cathay Pacific', 'code' => 'CX', 'country' => 'Hong Kong', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('airlines')->insert($airlines);
    }
}
