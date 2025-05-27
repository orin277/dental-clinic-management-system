<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Services\DentistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService,
                                private DentistService $dentistService)
    {

    }

    public function index(Request $request) {
        $dentist = $this->dentistService->findByUserId(Auth::user()->id);
        $monthlyPayments = $this->dashboardService->getDentistIncomeForCertainYear($dentist->id, 2024);

        return view('dentist/dashboard/index', compact('monthlyPayments'));
    }

    public function getIncomeForCertainYear(Request $request) {
        $dentist = $this->dentistService->findByUserId(Auth::user()->id);
        $monthlyPayments = $this->dashboardService->getDentistIncomeForCertainYear($dentist->id, $request->get('year'));

        return response()->json($monthlyPayments);
    }

    public function getNumberOfVisitorsForCertainYear(Request $request) {
        $dentist = $this->dentistService->findByUserId(Auth::user()->id);
        $monthlyAppointments = $this->dashboardService->getNumberOfVisitsToDentistForCertainYear($dentist->id, $request->get('year'));

        return response()->json($monthlyAppointments);
    }
}
