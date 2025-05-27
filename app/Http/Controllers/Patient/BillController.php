<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Services\BillService;
use App\Services\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function __construct(private BillService $billService)
    {

    }

    public function index(Request $request) {
        try {
            $bills = $this->billService->findAllForPatient(Auth::user()->patient->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('patient/bill/index', compact('bills'));
    }
}
