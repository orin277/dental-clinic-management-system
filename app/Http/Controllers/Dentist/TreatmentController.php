<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\UpdateServiceRequest;
use App\Http\Requests\Dentist\Treatment\StoreTreatmentRequest;
use App\Models\Tooth;
use App\Models\Treatment;
use App\Services\ToothService;
use App\Services\TreatmentService;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function __construct(private TreatmentService $treatmentService,
                                private ToothService $toothService)
    {

    }

    public function store(StoreTreatmentRequest $request) {
        try {
            $validated = $request->validated();
            $treatment = $this->treatmentService->create($validated);
            $tooth = $this->toothService->findById($treatment->tooth_id);
            $treatment['tooth_number'] = $tooth['number'];
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return response()->json($treatment);
    }

    public function manage($appointmentId) {
        try {
            $treatments = $this->treatmentService->findByAppointmentId($appointmentId);
            $teeth = Tooth::get();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('dentist/treatment/manage', compact('treatments', 'teeth', 'appointmentId'));
    }

    public function edit(Treatment $treatment) {
        try {
            $treatment = $this->treatmentService->findById($treatment->id);
            $teeth = $this->toothService->findAll();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('dentist/treatment/edit', compact('treatment', 'teeth'));
    }

    public function update(UpdateServiceRequest $request, Treatment $treatment) {
        try {
            $validated = $request->validated();
            $this->treatmentService->update($validated, $treatment);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('dentist.treatments.edit', $treatment->id);
    }

    public function destroy(Treatment $treatment) {
        try {
            $this->treatmentService->deleteById($treatment->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('dentist.treatments.manage');
    }
}
