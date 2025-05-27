<?php

namespace App\Services;

use App\Http\Filters\FiltersAppointmentSearch;
use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AppointmentService
{
    public function findAllForAdmin()
    {
        $fields = ['user_patients.name as patient_name',
            'user_patients.surname as patient_surname',
            'user_patients.patronymic as patient_patronymic',
            'user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'dentists.cabinet', 'appointment_statuses.name as appointment_status_name',
            'appointments.date', 'appointments.start_time', 'appointments.end_time',
            'appointments.id'];

        $query = QueryBuilder::for(Appointment::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersAppointmentSearch),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ]);

        $result = $query->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->join('appointment_statuses', 'appointments.appointment_status_id', '=', 'appointment_statuses.id')
            ->paginate(15);

        return $result;
    }

    public function findAllForDentist($dentistId)
    {
        $fields = ['user_patients.name as patient_name',
            'user_patients.surname as patient_surname',
            'user_patients.patronymic as patient_patronymic',
            'appointment_statuses.id as appointment_status_id',
            'appointments.date', 'appointments.start_time', 'appointments.end_time',
            'appointments.id'];

        $query = QueryBuilder::for(Appointment::class)
            ->select($fields)
            ->allowedFilters([
                'appointment_status_id',
                'date'
            ]);

        $result = $query->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('appointment_statuses', 'appointments.appointment_status_id', '=', 'appointment_statuses.id')
            ->byDentistId($dentistId)
            ->paginate(15);

        return $result;
    }

    public function findAllForPatient($patientId)
    {
        $fields = ['user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'dentists.cabinet',
            'dentist_specializations.name as dentist_specialization_name',
            'appointment_statuses.id as appointment_status_id',
            'appointments.date', 'appointments.start_time', 'appointments.end_time',
            'appointments.id'];

        $query = QueryBuilder::for(Appointment::class)
            ->select($fields)
            ->allowedFilters([
                'appointment_status_id',
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ]);

        $result = $query->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->join('appointment_statuses', 'appointments.appointment_status_id', '=', 'appointment_statuses.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->byPatientId($patientId)
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $appointment = Appointment::select(
            'user_patients.name as patient_name',
            'user_patients.surname as patient_surname',
            'user_patients.patronymic as patient_patronymic',
            'user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'dentists.cabinet', 'appointments.*',
            'appointment_statuses.name as appointment_status_name',
            'appointment_statuses.id as appointment_status_id',
            'dentist_specializations.name as dentist_specialization_name')
            ->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->join('appointment_statuses', 'appointments.appointment_status_id', '=', 'appointment_statuses.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->where('appointments.id', '=', $id)
            ->firstOrFail();

        return $appointment;
    }

    public function findByDentistIdAndDate($dentistId, $date)
    {
        $appointments = Appointment::where('appointments.dentist_id', '=', $dentistId)
            ->where('appointments.date', '=', $date)
            ->pluck('start_time');

        return $appointments;
    }

    public function findByPatientId($patientId)
    {
        $appointments = Appointment::select(
            'user_patients.name as patient_name',
            'user_patients.surname as patient_surname',
            'user_patients.patronymic as patient_patronymic',
            'user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'dentists.cabinet', 'appointments.*', 'appointment_statuses.name as appointment_status_name',
            'dentist_specializations.name as dentist_specialization_name')
            ->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->join('appointment_statuses', 'appointments.appointment_status_id', '=', 'appointment_statuses.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->where('appointments.patient_id', '=', $patientId)
            ->get();

        return $appointments;
    }

    public function create(array $data)
    {
        $appointment = Appointment::create($data);

        return $appointment;
    }

    public function update(array $data, Appointment $appointment): Appointment
    {
        $appointment->update($data);
        return $appointment;
    }

    public function cancel(Appointment $appointment): Appointment
    {
        $appointment->appointment_status_id = 2;
        $appointment->save();
        return $appointment;
    }

    public function deleteById(int $id): void
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
    }
}
