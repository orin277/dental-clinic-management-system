<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Weekend\StoreWeekendRequest;
use App\Http\Requests\Admin\Weekend\UpdateWeekendRequest;
use App\Models\Weekend;
use App\Services\WeekendService;
use Illuminate\Http\Request;

class WeekendController extends Controller
{
    public function __construct(private WeekendService $weekendService)
    {

    }

    public function index(Request $request) {
        try {
            $weekends = $this->weekendService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/weekend/index', compact('weekends'));
    }

    public function create() {
        return view('admin/weekend/create');
    }

    public function store(StoreWeekendRequest $request) {
        try {
            $validated = $request->validated();
            $this->weekendService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.weekends.index');
    }

    public function edit(Weekend $weekend) {
        try {
            $weekend = $this->weekendService->findById($weekend->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/weekend/edit', compact('weekend'));
    }

    public function update(UpdateWeekendRequest $request, Weekend $weekend) {
        try {
            $validated = $request->validated();
            $this->weekendService->update($validated, $weekend);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.weekends.edit', $weekend->id);
    }

    public function destroy(Weekend $weekend) {
        try {
            $this->weekendService->deleteById($weekend->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.weekends.index');
    }
}
