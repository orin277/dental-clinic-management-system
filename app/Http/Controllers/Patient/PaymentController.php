<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Services\PatientService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService,
                                private PatientService $patientService)
    {

    }

    public function index(Request $request) {
        try {
            $payments = $this->paymentService->findAllForPatient(Auth::user()->patient->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('patient/payment/index', compact('payments'));
    }
}
