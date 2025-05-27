<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PdfService;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function __construct(private PdfService $pdfService)
    {

    }

    public function generatePdfIncomeForCertainYear($year)
    {
        $pdf = $this->pdfService->generatePdfIncomeForCertainYear($year);
        return $pdf->download('document.pdf');
    }

    public function generatePdfNumberOfVisitorsForCertainYear($year)
    {
        $pdf = $this->pdfService->generatePdfNumberOfVisitorsForCertainYear($year);
        return $pdf->download('document.pdf');
    }
}
