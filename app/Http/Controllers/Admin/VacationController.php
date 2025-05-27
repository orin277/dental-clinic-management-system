<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Vacation\StoreVacationRequest;
use App\Http\Requests\Admin\Vacation\UpdateVacationRequest;
use App\Models\Vacation;
use App\Services\DentistService;
use App\Services\VacationService;
use Illuminate\Http\Request;

class VacationController
{
    public function __construct(private VacationService $vacationService,
                                private DentistService $dentistService)
    {

    }

    public function index(Request $request) {
        try {
            $vacations = $this->vacationService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/vacation/index', compact('vacations'));
    }

    public function create() {
        try {
            $dentists = $this->dentistService->getDentistsForDropdownList();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/vacation/create', compact('dentists'));
    }

    public function store(StoreVacationRequest $request) {
        try {
            $validated = $request->validated();
            $this->vacationService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.vacations.index');
    }

    public function edit(Vacation $vacation) {
        try {
            $dentists = $this->dentistService->getDentistsForDropdownList();
            $vacation = $this->vacationService->findById($vacation->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/vacation/edit', compact('vacation', 'dentists'));
    }

    public function update(UpdateVacationRequest $request, Vacation $vacation) {
        try {
            $validated = $request->validated();
            $this->vacationService->update($validated, $vacation);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.vacations.edit', $vacation->id);
    }

    public function destroy(Vacation $vacation) {
        try {
            $this->vacationService->deleteById($vacation->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.vacations.index');
    }

    public function getVacations(Request $request) {
        $vacations = [];
        if ($request->has('dentist-id')) {
            $vacations = $this->vacationService->findByDentistId($request->query('dentist-id'));
        }

        return response()->json($vacations);
    }
}
