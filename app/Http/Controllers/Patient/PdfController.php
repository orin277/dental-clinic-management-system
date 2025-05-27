<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Services\PatientService;
use App\Services\PdfService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function __construct(private PdfService $pdfService,
                                private PatientService $patientService)
    {

    }

    public function generatePdfExpensesForLastTenYears()
    {
        $patient = $this->patientService->findByUserId(Auth::user()->id);
        $pdf = $this->pdfService->generatePdfExpensesForLastTenYearsForPatient($patient);
        return $pdf->download('document.pdf');
    }

    public function generatePdfNumberOfVisitsInLastTenYears()
    {
        $patient = $this->patientService->findByUserId(Auth::user()->id);
        $pdf = $this->pdfService->generatePdfNumberOfVisitsInLastTenYearsForPatient($patient);
        return $pdf->download('document.pdf');
    }
}
