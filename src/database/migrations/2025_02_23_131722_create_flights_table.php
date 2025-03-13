<?php

use App\Enums\FlightStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number');
            $table->foreignId('airline_id')->references('id')->on('airlines');
            $table->foreignId('departure_airport_id')->references('id')->on('airports');
            $table->foreignId('arrival_airport_id')->references('id')->on('airports');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->date('flight_date');
            $table->decimal('price', 10, 2);
            $table->integer('allowed_kg')->default(20);
            $table->enum('status', \App\Enums\FlightStatus::values())->default(FlightStatus::SCHEDULED);
            $table->integer('available_seats');
            $table->softDeletes();
            $table->timestamps();

            // Index
            $table->index('flight_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
