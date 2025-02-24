<?php

use App\Enums\BookingStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->references('id')->on('flights');
            $table->enum('status', \App\Enums\BookingStatus::values())->default(BookingStatus::PENDING);
            $table->dateTime('booked_at')->default(now());
            $table->string('booked_by')->comment('Person who made this booking');
            $table->string('booked_email')->comment('Person email who made this booking');
            $table->string('booked_phone')->comment('Person phone who made this booking');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
