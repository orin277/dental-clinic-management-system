<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService)
    {

    }

    public function index(Request $request) {
        return view('admin/dashboard/index');
    }

    public function getIncomeForCertainYear(Request $request) {
        $monthlyPayments = $this->dashboardService->getIncomeForCertainYear($request->get('year'));

        return response()->json($monthlyPayments);
    }

    public function getNumberOfVisitorsForCertainYear(Request $request) {
        $monthlyAppointments = $this->dashboardService->getNumberOfVisitorsForCertainYear($request->get('year'));

        return response()->json($monthlyAppointments);
    }
}
