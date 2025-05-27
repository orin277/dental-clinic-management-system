<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Payment\StorePaymentRequest;
use App\Http\Requests\Admin\Payment\UpdatePaymentRequest;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController
{
    public function __construct(private PaymentService $paymentService)
    {

    }

    public function index(Request $request) {
        try {
            $payments = $this->paymentService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/payment/index', compact('payments'));
    }

    public function create() {
        return view('admin/payment/create');
    }

    public function store(StorePaymentRequest $request) {
        try {
            $validated = $request->validated();
            $this->paymentService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        if (Auth::user()->hasRole('receptionist')) {
            return redirect()->route('receptionist.payments.index');
        }

        return redirect()->route('admin.payments.index');
    }

    public function edit(Payment $payment) {
        try {
            $payment = $this->paymentService->findById($payment->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/payment/edit', compact('payment'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment) {
        try {
            $validated = $request->validated();
            $this->paymentService->update($validated, $payment);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        if (Auth::user()->hasRole('receptionist')) {
            return redirect()->route('receptionist.payments.edit');
        }

        return redirect()->route('admin.payments.edit', $payment->id);
    }

    public function destroy(Payment $payment) {
        try {
            $this->paymentService->deleteById($payment->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        if (Auth::user()->hasRole('receptionist')) {
            return redirect()->route('receptionist.payments.index');
        }

        return redirect()->route('admin.payments.index');
    }
}
