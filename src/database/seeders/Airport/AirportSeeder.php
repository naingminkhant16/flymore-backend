<?php

namespace Database\Seeders\Airport;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $airports = [
            // Myanmar Airports
            ['name' => 'Yangon International Airport', 'code' => 'RGN', 'city' => 'Yangon', 'country' => 'Myanmar', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mandalay International Airport', 'code' => 'MDL', 'city' => 'Mandalay', 'country' => 'Myanmar', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Naypyidaw International Airport', 'code' => 'NYT', 'city' => 'Naypyidaw', 'country' => 'Myanmar', 'created_at' => $now, 'updated_at' => $now],

            // Thailand Airports
            ['name' => 'Suvarnabhumi Airport', 'code' => 'BKK', 'city' => 'Bangkok', 'country' => 'Thailand', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Don Mueang International Airport', 'code' => 'DMK', 'city' => 'Bangkok', 'country' => 'Thailand', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Phuket International Airport', 'code' => 'HKT', 'city' => 'Phuket', 'country' => 'Thailand', 'created_at' => $now, 'updated_at' => $now],

            // Singapore Airport
            ['name' => 'Changi Airport', 'code' => 'SIN', 'city' => 'Singapore', 'country' => 'Singapore', 'created_at' => $now, 'updated_at' => $now],

            // Malaysia Airports
            ['name' => 'Kuala Lumpur International Airport', 'code' => 'KUL', 'city' => 'Kuala Lumpur', 'country' => 'Malaysia', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Penang International Airport', 'code' => 'PEN', 'city' => 'Penang', 'country' => 'Malaysia', 'created_at' => $now, 'updated_at' => $now],

            // Indonesia Airports
            ['name' => 'Soekarno-Hatta International Airport', 'code' => 'CGK', 'city' => 'Jakarta', 'country' => 'Indonesia', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ngurah Rai International Airport', 'code' => 'DPS', 'city' => 'Bali', 'country' => 'Indonesia', 'created_at' => $now, 'updated_at' => $now],

            // Philippines Airports
            ['name' => 'Ninoy Aquino International Airport', 'code' => 'MNL', 'city' => 'Manila', 'country' => 'Philippines', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mactan-Cebu International Airport', 'code' => 'CEB', 'city' => 'Cebu', 'country' => 'Philippines', 'created_at' => $now, 'updated_at' => $now],

            // Vietnam Airports
            ['name' => 'Noi Bai International Airport', 'code' => 'HAN', 'city' => 'Hanoi', 'country' => 'Vietnam', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tan Son Nhat International Airport', 'code' => 'SGN', 'city' => 'Ho Chi Minh City', 'country' => 'Vietnam', 'created_at' => $now, 'updated_at' => $now],

            // Japan Airports
            ['name' => 'Narita International Airport', 'code' => 'NRT', 'city' => 'Tokyo', 'country' => 'Japan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Haneda Airport', 'code' => 'HND', 'city' => 'Tokyo', 'country' => 'Japan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kansai International Airport', 'code' => 'KIX', 'city' => 'Osaka', 'country' => 'Japan', 'created_at' => $now, 'updated_at' => $now],

            // South Korea Airports
            ['name' => 'Incheon International Airport', 'code' => 'ICN', 'city' => 'Seoul', 'country' => 'South Korea', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Gimpo International Airport', 'code' => 'GMP', 'city' => 'Seoul', 'country' => 'South Korea', 'created_at' => $now, 'updated_at' => $now],

            // China Airports
            ['name' => 'Beijing Capital International Airport', 'code' => 'PEK', 'city' => 'Beijing', 'country' => 'China', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Shanghai Pudong International Airport', 'code' => 'PVG', 'city' => 'Shanghai', 'country' => 'China', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Guangzhou Baiyun International Airport', 'code' => 'CAN', 'city' => 'Guangzhou', 'country' => 'China', 'created_at' => $now, 'updated_at' => $now],

            // India Airports
            ['name' => 'Indira Gandhi International Airport', 'code' => 'DEL', 'city' => 'New Delhi', 'country' => 'India', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Chhatrapati Shivaji Maharaj International Airport', 'code' => 'BOM', 'city' => 'Mumbai', 'country' => 'India', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kempegowda International Airport', 'code' => 'BLR', 'city' => 'Bangalore', 'country' => 'India', 'created_at' => $now, 'updated_at' => $now],

            // Hong Kong Airport
            ['name' => 'Hong Kong International Airport', 'code' => 'HKG', 'city' => 'Hong Kong', 'country' => 'Hong Kong', 'created_at' => $now, 'updated_at' => $now],

            // Taiwan Airport
            ['name' => 'Taiwan Taoyuan International Airport', 'code' => 'TPE', 'city' => 'Taipei', 'country' => 'Taiwan', 'created_at' => $now, 'updated_at' => $now]
        ];

        DB::table('airports')->insert($airports);
    }
}
