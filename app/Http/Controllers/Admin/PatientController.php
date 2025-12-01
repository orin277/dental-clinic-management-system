<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Patient\StorePatientRequest;
use App\Http\Requests\Admin\Patient\UpdatePatientRequest;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PatientController
{
    public function __construct(private PatientService $patientService)
    {
    }

    public function index(Request $request) {
        try {
            $patients = $this->patientService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        return view('admin/patient/index', compact('patients'));
    }

    public function create() {
        return view('admin/patient/create');
    }

    public function store(StorePatientRequest $request) {
        try {
            $validated = $request->validated();
            $this->patientService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.patients.index');
    }

    public function edit(Patient $patient) {
        try {
            $patient = $this->patientService->findById($patient->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/patient/edit', compact('patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient) {
        try {
            $validated = $request->validated();
            $this->patientService->update($validated, $patient);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.patients.edit', $patient->id);
    }

    public function destroy(Patient $patient) {
        try {
            $this->patientService->deleteById($patient->id);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()
                    ->withError("Неможливо видалити пацієнта, оскільки існують пов'язані записи")
                    ->withInput();
            }
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.patients.index');
    }
}
