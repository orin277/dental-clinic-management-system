<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Receptionist\StoreReceptionistRequest;
use App\Http\Requests\Admin\Receptionist\UpdateReceptionistRequest;
use App\Models\Receptionist;
use App\Services\ReceptionistService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ReceptionistController
{
    public function __construct(private ReceptionistService $receptionistService)
    {
    }

    public function index(Request $request) {
        try {
            $receptionists = $this->receptionistService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/receptionist/index', compact('receptionists'));
    }

    public function create() {
        return view('admin/receptionist/create');
    }

    public function store(StoreReceptionistRequest $request) {
        try {
            $validated = $request->validated();
            $this->receptionistService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.receptionists.index');
    }

    public function edit(Receptionist $receptionist) {
        try {
            $receptionist = $this->receptionistService->findById($receptionist->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/receptionist/edit', compact('receptionist'));
    }

    public function update(UpdateReceptionistRequest $request, Receptionist $receptionist) {
        try {
            $validated = $request->validated();
            $this->receptionistService->update($validated, $receptionist);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.receptionists.edit', $receptionist->id);
    }

    public function destroy(Receptionist $receptionist) {
        try {
            $this->receptionistService->deleteById($receptionist->id);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()
                    ->withError("Неможливо видалити реєстратора, оскільки існують пов'язані записи")
                    ->withInput();
            }
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.receptionists.index');
    }
}
