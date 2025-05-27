<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\StoreServiceRequest;
use App\Http\Requests\Admin\Service\UpdateServiceRequest;
use App\Models\Service;
use App\Services\ServiceService;
use App\Services\TypeOfServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private ServiceService $serviceService,
                                private TypeOfServiceService $typeOfServiceService)
    {

    }

    public function index(Request $request) {
        try {
            $services = $this->serviceService->findAllForAdmin();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/service/index', compact('services'));
    }

    public function create() {
        try {
            $typeOfServices = $this->typeOfServiceService->findAll();
            $services = $this->serviceService->findAll();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/service/create', compact('services', 'typeOfServices'));
    }

    public function store(StoreServiceRequest $request) {
        try {
            $validated = $request->validated();
            $this->serviceService->create($validated);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service) {
        try {
            $typeOfServices = $this->typeOfServiceService->findAll();
            $service = $this->serviceService->findById($service->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/service/edit', compact('service', 'typeOfServices'));
    }

    public function update(UpdateServiceRequest $request, Service $service) {
        try {
            $validated = $request->validated();
            $this->serviceService->update($validated, $service);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.services.edit', $service->id);
    }

    public function destroy(Service $service) {
        try {
            $this->serviceService->deleteById($service->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.services.index');
    }
}
