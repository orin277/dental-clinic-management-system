<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Service\UpdateServiceRequest;
use App\Http\Requests\Admin\Treatment\StoreTreatmentRequest;
use App\Http\Requests\Admin\Treatment\UpdateTreatmentRequest;
use App\Models\Treatment;
use App\Services\AppointmentService;
use App\Services\ToothService;
use App\Services\TreatmentService;
use Illuminate\Http\Request;

class TreatmentController
{
    public function __construct(private AppointmentService $appointmentService,
                                private TreatmentService $treatmentService,
                                private ToothService $toothService)
    {

    }

    public function index(Request $request) {
        try {
            $treatments = $this->treatmentService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/treatment/index', compact('treatments'));
    }

    public function create() {
        try {
            $teeth = $this->toothService->findAll();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/treatment/create', compact('teeth'));
    }

    public function store(StoreTreatmentRequest $request) {
        try {
            $validated = $request->validated();
            $this->treatmentService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.treatments.index');
    }

    public function edit(Treatment $treatment) {
        try {
            $treatment = $this->treatmentService->findById($treatment->id);
            $teeth = $this->toothService->findAll();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/treatment/edit', compact('treatment', 'teeth'));
    }

    public function update(UpdateTreatmentRequest $request, Treatment $treatment) {
        try {
            $validated = $request->validated();
            $this->treatmentService->update($validated, $treatment);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.treatments.edit', $treatment->id);
    }

    public function destroy(Treatment $treatment) {
        try {
            $this->treatmentService->deleteById($treatment->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.treatments.index');
    }
}
