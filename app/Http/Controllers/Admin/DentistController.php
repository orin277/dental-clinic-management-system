<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Dentist\StoreDentistRequest;
use App\Http\Requests\Admin\Dentist\UpdateDentistRequest;
use App\Models\Dentist;
use App\Models\DentistSpecialization;
use App\Services\DentistService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DentistController extends Controller
{
    public function __construct(private DentistService $dentistService)
    {
    }

    public function index(Request $request) {
        try {
            $dentists = $this->dentistService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/dentist/index', compact('dentists'));
    }

    public function create() {
        try {
            $dentistSpecializations = DentistSpecialization::get();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/dentist/create', compact('dentistSpecializations'));
    }

    public function store(StoreDentistRequest $request) {
        try {
            $validated = $request->validated();
            $this->dentistService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.dentists.index');
    }

    public function edit(Dentist $dentist) {
        try {
            $dentistSpecializations = DentistSpecialization::get();
            $dentist = $this->dentistService->findById($dentist->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/dentist/edit', compact('dentist', 'dentistSpecializations'));
    }

    public function update(UpdateDentistRequest $request, Dentist $dentist) {
        try {
            $validated = $request->validated();
            $this->dentistService->update($validated, $dentist);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.dentists.edit', $dentist->id);
    }

    public function destroy(Dentist $dentist) {
        try {
            $this->dentistService->deleteById($dentist->id);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()
                    ->withError("Неможливо видалити стоматолога, оскільки існують пов'язані записи")
                    ->withInput();
            }
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.dentists.index');
    }

    public function getDentist(Request $request, $id) {
        $dentist = $this->dentistService->findById($id);

        return response()->json($dentist);
    }
}
