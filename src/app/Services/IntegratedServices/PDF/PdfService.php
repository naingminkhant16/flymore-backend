<?php

namespace App\Services\IntegratedServices\PDF;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfService implements PdfServiceInterface
{
    /**
     * Generate E-Ticket booking
     * @param Booking $booking
     * @return void
     */
    public function generateETicket(Booking $booking): void
    {
        $pdf = Pdf::loadView('mails.booking.eticket', ['booking' => $booking])
            ->setBasePath(public_path('pdf'));
        $pdf->setPaper('A4');

        $pdf->setOptions(['isRemoteEnabled' => true]);

        if (!Storage::disk('public')->exists('tickets'))
            Storage::disk('public')->makeDirectory('tickets');

        $filePath = 'tickets/e-ticket-' . $booking->id . '.pdf';
        $pdf->save($filePath, 'public');
    }
}
