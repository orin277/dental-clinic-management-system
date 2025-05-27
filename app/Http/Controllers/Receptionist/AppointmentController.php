<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Services\AppointmentStatusService;
use App\Services\DentistService;
use App\Services\PatientService;
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
            $appointments = $this->appointmentService->findAll($request->all());
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
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/appointment/create', compact('dentists', 'patients', 'appointmentStatuses'));
    }

    public function store(Request $request) {
        try {
            $this->appointmentService->create($request->all());
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment) {
        try {
            $appointmentStatuses = $this->appointmentStatusService->findAll();

            $dentists = $this->dentistService->getDentistsForDropdownList();
            $patients = $this->patientService->getPatientsForDropdownList();

            $appointment = $this->appointmentService->findById($appointment->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('admin/appointment/edit', compact('appointment',
            'dentists', 'patients', 'appointmentStatuses'));
    }

    public function update(Request $request, Appointment $appointment) {
        try {
            $this->appointmentService->update($request->all(), $appointment);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('admin.appointments.edit', $appointment->id);
    }

    public function destroy(Appointment $appointment) {
        try {
            $this->appointmentService->deleteById($appointment->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
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
