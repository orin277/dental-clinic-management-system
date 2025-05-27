<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Education\StoreEducationRequest;
use App\Http\Requests\Admin\Education\UpdateEducationRequest;
use App\Models\education;
use App\Services\DentistService;
use App\Services\EducationService;
use Illuminate\Http\Request;

class EducationController
{
    public function __construct(private EducationService $educationService,
                                private DentistService $dentistService)
    {

    }

    public function index(Request $request) {
        try {
            $educations = $this->educationService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/education/index', compact('educations'));
    }

    public function create() {
        try {
            $dentists = $this->dentistService->getDentistsForDropdownList();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/education/create', compact('dentists'));
    }

    public function store(StoreEducationRequest $request) {
        try {
            $validated = $request->validated();
            $this->educationService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.educations.index');
    }

    public function edit(Education $education) {
        try {
            $dentists = $this->dentistService->getDentistsForDropdownList();
            $education = $this->educationService->findById($education->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/education/edit', compact('education', 'dentists'));
    }

    public function update(UpdateEducationRequest $request, Education $education) {
        try {
            $validated = $request->validated();
            $this->educationService->update($validated, $education);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.educations.edit', $education->id);
    }

    public function destroy(Education $education) {
        try {
            $this->educationService->deleteById($education->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.educations.index');
    }
}
