<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Admin\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Services\AppointmentStatusService;
use App\Services\DentistService;
use App\Services\PatientService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function __construct(private AppointmentService $appointmentService,
                                private DentistService $dentistService,
                                private PatientService $patientService,
                                private AppointmentStatusService $appointmentStatusService)
    {

    }

    public function index(Request $request) {
        try {
            $appointments = $this->appointmentService->findAllForAdmin();
        } catch (QueryException $e) {
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/appointment/index', compact('appointments'));
    }

    public function create() {
        try {
            $appointmentStatuses = $this->appointmentStatusService->findAll();

            $dentists = $this->dentistService->getDentistsForDropdownList();
            $patients = $this->patientService->getPatientsForDropdownList();
        } catch (QueryException $e) {
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/appointment/create', compact('dentists', 'patients', 'appointmentStatuses'));
    }

    public function store(StoreAppointmentRequest $request) {
        try {
            $validated = $request->validated();

            $this->appointmentService->create($validated);
        } catch (QueryException $e) {
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        if (Auth::user()->hasRole('receptionist')) {
            return redirect()->route('receptionist.appointments.index');
        }

        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment) {
        try {
            $appointmentStatuses = $this->appointmentStatusService->findAll();

            $dentists = $this->dentistService->getDentistsForDropdownList();
            $patients = $this->patientService->getPatientsForDropdownList();

            $appointment = $this->appointmentService->findById($appointment->id);
        } catch (QueryException $e) {
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }


        return view('admin/appointment/edit', compact('appointment',
            'dentists', 'patients', 'appointmentStatuses'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment) {
        try {
            $validated = $request->validated();

            $this->appointmentService->update($validated, $appointment);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()
                    ->withError("Неможливо оновити прийом, оскільки існують пов'язані записи")
                    ->withInput();
            }
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        if (Auth::user()->hasRole('receptionist')) {
            return redirect()->route('receptionist.appointments.edit', $appointment->id);
        }

        return redirect()->route('admin.appointments.edit', $appointment->id);
    }

    public function destroy(Appointment $appointment) {
        try {
            $this->appointmentService->deleteById($appointment->id);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return back()
                    ->withError("Неможливо видалити прийом, оскільки існують пов'язані записи")
                    ->withInput();
            }
            return back()->withError($e->getMessage())->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        if (Auth::user()->hasRole('receptionist')) {
            return redirect()->route('receptionist.appointments.index');
        }

        return redirect()->route('admin.appointments.index');
    }

    public function getAppointments(Request $request) {
        $appointments = [];
        if ($request->has('dentist-id') and $request->has('date')) {
            $appointments = $this->appointmentService->findByDentistIdAndDate($request->query('dentist-id'),
                $request->query('date'));
        }

        return response()->json($appointments);
    }
}
