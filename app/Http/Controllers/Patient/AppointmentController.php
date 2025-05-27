<?php

namespace App\Http\Controllers\Patient;

use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Services\AppointmentStatusService;
use App\Services\DentistService;
use App\Services\PatientService;
use App\Services\TreatmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AppointmentController
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
            $appointments = $this->appointmentService->findAllForPatient(Auth::user()->patient->id);
            $appointmentStatuses = $this->appointmentStatusService->findAll();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('patient/appointment/index', compact('appointments', 'appointmentStatuses'));
    }

    public function create() {
        try {
            $dentists = $this->dentistService->getDentistsForDropdownListAppointmentBooking();
            $patient = $this->patientService->findByUserId(Auth::user()->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('patient/appointment/create', compact('dentists', 'patient'));
    }

    public function store(Request $request) {
        try {
            $result = $this->appointmentService->create($request->all());
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return response()->json(['message' => $result ], 200);
    }

    public function show(Appointment  $appointment) {
        try {
            $treatments = $this->treatmentService->findByAppointmentId($appointment->id);
            $appointment = $this->appointmentService->findById($appointment->id);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('patient/appointment/show', compact('appointment', 'treatments'));
    }

    public function cancel(Request $request, Appointment  $appointment) {
        $this->appointmentService->cancel($appointment);
        return response()->json(['message' =>  'Запис скасовано!'], 200);
    }
}
