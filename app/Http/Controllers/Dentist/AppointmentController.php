<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dentist\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Tooth;
use App\Services\AppointmentService;
use App\Services\AppointmentStatusService;
use App\Services\DentistService;
use App\Services\PatientService;
use App\Services\TreatmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function __construct(private AppointmentService $appointmentService,
                                private DentistService $dentistService,
                                private PatientService $patientService,
                                private AppointmentStatusService $appointmentStatusService,
                                private TreatmentService $treatmentService)
    {

    }

    public function index(Request $request) {
        try {
            $appointments = $this->appointmentService->findAllForDentist(Auth::user()->dentist->id);
            $appointmentStatuses = $this->appointmentStatusService->findAll();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('dentist/appointment/index', compact('appointments', 'appointmentStatuses'));
    }

    public function edit(Appointment $appointment) {
        try {
            $appointmentStatuses = $this->appointmentStatusService->findAll();
            $appointment = $this->appointmentService->findById($appointment->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('dentist/appointment/edit', compact('appointment', 'appointmentStatuses'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment) {
        try {
            $validated = $request->validated();
            $this->appointmentService->update($validated, $appointment);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('dentist.appointments.edit', $appointment->id);
    }
}
