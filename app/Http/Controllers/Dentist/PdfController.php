<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Services\DentistService;
use App\Services\PdfService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function __construct(private PdfService $pdfService,
                                private DentistService $dentistService)
    {

    }

    public function generatePdfNumberOfVisitsForCertainYear($year)
    {
        $dentist = $this->dentistService->findByUserId(Auth::user()->id);
        $pdf = $this->pdfService->generatePdfNumberOfVisitsToDentistForCertainYear($dentist, $year);
        return $pdf->download('document.pdf');
    }

    public function generatePdfIncomeForCertainYear($year)
    {
        $dentist = $this->dentistService->findByUserId(Auth::user()->id);
        $pdf = $this->pdfService->generatePdfDentistIncomeForCertainYear($dentist, $year);
        return $pdf->download('document.pdf');
    }

    public function generatePdfInformationAboutAppointment($id)
    {
        $pdf = $this->pdfService->generatePdfInformationAboutAppointment($id);
        return $pdf->download('document.pdf');
    }

    public function generatePdfInformationAboutTreatment($appointmentId)
    {
        $pdf = $this->pdfService->generatePdfInformationAboutTreatment($appointmentId);
        return $pdf->download('document.pdf');
    }

    public function generatePdfInformationAboutBills($appointmentId)
    {
        $pdf = $this->pdfService->generatePdfInformationAboutBills($appointmentId);
        return $pdf->download('document.pdf');
    }
}
