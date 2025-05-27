<?php

namespace App\Services;

use App\Http\Filters\FiltersAppointmentSearch;
use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TreatmentService
{
    public function findAll($params = [], $fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['user_patients.name as patient_name',
                'user_patients.surname as patient_surname',
                'user_patients.patronymic as patient_patronymic',
                'user_dentists.name as dentist_name',
                'user_dentists.surname as dentist_surname',
                'user_dentists.patronymic as dentist_patronymic',
                'appointments.date', 'treatments.*', 'teeth.number as tooth_number'];
        }

        $query = QueryBuilder::for(Treatment::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersAppointmentSearch),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ]);

        $result = $query
            ->join('appointments', 'treatments.appointment_id', '=', 'appointments.id')
            ->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->join('teeth', 'treatments.tooth_id', '=', 'teeth.id')
            ->paginate(15);

        return $result;
    }

    public function findAllForAdmin()
    {
        $fields = ['user_patients.name as patient_name',
            'user_patients.surname as patient_surname',
            'user_patients.patronymic as patient_patronymic',
            'user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'appointments.id as appointment_id', 'appointments.date',
            'treatments.id', 'treatments.diagnosis', 'teeth.number as tooth_number'];

        $query = QueryBuilder::for(Treatment::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersAppointmentSearch),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ]);

        $result = $query
            ->join('appointments', 'treatments.appointment_id', '=', 'appointments.id')
            ->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->join('teeth', 'treatments.tooth_id', '=', 'teeth.id')
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $treatment = Treatment::select('user_patients.name as patient_name',
            'user_patients.surname as patient_surname',
            'user_patients.patronymic as patient_patronymic',
            'user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'appointments.date', 'treatments.*', 'teeth.number as tooth_number')
            ->join('appointments', 'treatments.appointment_id', '=', 'appointments.id')
            ->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->join('teeth', 'treatments.tooth_id', '=', 'teeth.id')
            ->where('treatments.id', '=', $id)
            ->firstOrFail();

        return $treatment;
    }

    public function findByAppointmentId($appointmentId)
    {
        $treatments = Treatment::select(
            'treatments.*', 'teeth.number as tooth_number')
            ->join('teeth', 'treatments.tooth_id', '=', 'teeth.id')
            ->where('treatments.appointment_id', '=', $appointmentId)
            ->get();

        return $treatments;
    }


    public function create(array $data)
    {
        try {
            $treatment = Treatment::create($data);
        }
        catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }

        return $treatment;
    }

    public function update(array $data, Treatment $treatment): Treatment
    {
        $treatment->update($data);
        return $treatment;
    }

    public function deleteById(int $id): void
    {
        $treatment = Treatment::find($id);
        $treatment->delete();
    }
}
