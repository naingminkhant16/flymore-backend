<?php

use App\Models\Booking;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    $booking = Booking::latest()->first();
    return view('mails.booking.eticket', compact('booking'));
});
