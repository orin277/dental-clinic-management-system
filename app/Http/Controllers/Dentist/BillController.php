<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dentist\Bill\StoreBillRequest;
use App\Models\Bill;
use App\Services\BillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function __construct(private BillService $billService)
    {

    }

    public function manage($appointmentId) {
        try {
            $bills = $this->billService->findByAppointmentId($appointmentId);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('dentist/bill/manage', compact('bills', 'appointmentId'));
    }

    public function store(StoreBillRequest $request) {
        try {
            $validated = $request->validated();
            $bill = $this->billService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return response()->json($bill);
    }

    public function destroy(Bill $bill) {
        try {
            $this->billService->deleteById($bill->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('dentist.bills.index');
    }
}
