<?php

namespace App\Services\IntegratedServices\PDF;

use App\Models\Booking;

interface PdfServiceInterface
{
    /**
     * Generate E-Ticket booking
     * @param Booking $booking
     * @return void
     */
    public function generateETicket(Booking $booking): void;
}
