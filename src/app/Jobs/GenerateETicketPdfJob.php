<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Services\IntegratedServices\PDF\PdfService;
use App\Services\IntegratedServices\PDF\PdfServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GenerateETicketPdfJob implements ShouldQueue
{
    use Queueable;
    private PdfServiceInterface $pdfService;
    /**
     * Create a new job instance.
     */
    public function __construct(private Booking $booking)
    {
        $this->pdfService = new PdfService();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->pdfService->generateETicket($this->booking);
    }
}
