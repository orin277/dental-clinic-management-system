<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminRequest;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(private AdminService $adminService)
    {
    }

    public function index(Request $request) {
        try {
            $admins = $this->adminService->findAll();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/admin/index', compact('admins'));
    }

    public function create() {
        return view('admin/admin/create');
    }

    public function store(StoreAdminRequest $request) {
        try {
            $validated = $request->validated();
            $this->adminService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.admins.index');
    }

    public function edit(User $admin) {
        try {
            $admin = $this->adminService->findById($admin->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/admin/edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, User $admin) {
        try {
            $validated = $request->validated();
            $this->adminService->update($validated, $admin);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()
                    ->withError("Неможливо оновити рахунок, оскільки існують пов'язані записи")
                    ->withInput();
            }
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.admins.edit', $admin->id);
    }

    public function destroy(User $admin) {
        try {
            $this->adminService->deleteById($admin->id);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()
                    ->withError("Неможливо видалити рахунок, оскільки існують пов'язані записи")
                    ->withInput();
            }
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.admins.index');
    }
}
