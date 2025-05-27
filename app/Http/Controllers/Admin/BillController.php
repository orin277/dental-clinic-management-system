<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Bill\StoreBillRequest;
use App\Http\Requests\Admin\Bill\UpdateBillRequest;
use App\Models\bill;
use App\Services\BillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController
{
    public function __construct(private BillService $billService)
    {

    }

    public function index(Request $request) {
        try {
            $bills = $this->billService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/bill/index', compact('bills'));
    }

    public function create() {
        return view('admin/bill/create');
    }

    public function store(StoreBillRequest $request) {
        try {
            $validated = $request->validated();
            $this->billService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        if (Auth::user()->hasRole('receptionist')) {
            return redirect()->route('receptionist.bills.index');
        }

        return redirect()->route('admin.bills.index');
    }

    public function edit(Bill $bill) {
        try {
            $bill = $this->billService->findById($bill->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/bill/edit', compact('bill'));
    }

    public function update(UpdateBillRequest $request, Bill $bill) {
        try {
            $validated = $request->validated();
            $this->billService->update($validated, $bill);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        if (Auth::user()->hasRole('receptionist')) {
            return redirect()->route('receptionist.bills.edit', $bill->id);
        }

        return redirect()->route('admin.bills.edit', $bill->id);
    }

    public function destroy(Bill $bill) {
        try {
            $this->billService->deleteById($bill->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        if (Auth::user()->hasRole('receptionist')) {
            return redirect()->route('receptionist.bills.index');
        }

        return redirect()->route('admin.bills.index');
    }
}
