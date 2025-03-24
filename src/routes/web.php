<?php

use App\Models\Booking;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    $booking = Booking::latest()->first();
    return view('mails.booking.eticket', compact('booking'));
});

Route::get('/test-rabbitmq', function () {
    try {
        Queue::connection('rabbitmq')->pushRaw('test message');
        return response()->json(['message' => 'RabbitMQ Connection Successful!']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'RabbitMQ Connection Failed', 'message' => $e->getMessage()], 500);
    }
});
