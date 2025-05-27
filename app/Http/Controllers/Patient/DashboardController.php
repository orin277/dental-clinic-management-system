<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Services\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService,
                                private PatientService $patientService)
    {

    }

    public function index(Request $request) {
        try {
            $patient = $this->patientService->findByUserId(Auth::user()->id);
            $yearlyPayments = $this->dashboardService->getExpensesForLastTenYearsForPatient($patient->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('patient/dashboard/index', compact('yearlyPayments'));
    }

    public function getExpensesForLastTenYearsForPatient(Request $request) {
        $patient = $this->patientService->findByUserId(Auth::user()->id);
        $yearlyPayments = $this->dashboardService->getExpensesForLastTenYearsForPatient($patient->id);

        return response()->json($yearlyPayments);
    }

    public function getNumberOfVisitsInLastTenYearsForPatient(Request $request) {
        $patient = $this->patientService->findByUserId(Auth::user()->id);
        $yearlyPayments = $this->dashboardService->getNumberOfVisitsInLastTenYearsForPatient($patient->id);

        return response()->json($yearlyPayments);
    }
}
