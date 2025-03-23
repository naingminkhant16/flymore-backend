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
     * @return string
     */
    public function generateETicket(Booking $booking): string
    {
        $pdf = Pdf::loadView('mails.booking.eticket', ['booking' => $booking])->setBasePath(public_path('pdf'));
        $pdf->setPaper('A4');
//        $options = $pdf->getOptions();
//        $options->setIsRemoteEnabled(true);
        $pdf->setOptions(['isRemoteEnabled' => true]);

        if (!Storage::disk('public')->exists('tickets'))
            Storage::disk('public')->makeDirectory('tickets');

        $filePath = 'tickets/e-ticket-' . $booking->id . '.pdf';
        $pdf->save($filePath, 'public');

        return $filePath;
    }
}
