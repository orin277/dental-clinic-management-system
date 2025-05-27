<?php

namespace App\Services;

use App\Http\Filters\FiltersAppointmentSearch;
use App\Models\Appointment;
use App\Models\Bill;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BillService
{
    public function findAll($fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['user_patients.name as patient_name',
                'user_patients.surname as patient_surname',
                'user_patients.patronymic as patient_patronymic',
                'user_dentists.name as dentist_name',
                'user_dentists.surname as dentist_surname',
                'user_dentists.patronymic as dentist_patronymic',
                'bills.*'];
        }

        $query = QueryBuilder::for(Bill::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersAppointmentSearch),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ]);

        $query = $query
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id');

        if ($paginate === true) {
            $result = $query->paginate(15);
        }
        else {
            $result = $query->get();
        }

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
            'bills.id', 'bills.amount', 'bills.date', 'bills.appointment_id'];

        $query = QueryBuilder::for(Bill::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersAppointmentSearch),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ]);

        $result = $query
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->paginate(15);

        return $result;
    }

    public function findAllForPatient($patientId)
    {
        $fields = ['bills.id', 'bills.amount', 'bills.date'];

        $query = QueryBuilder::for(Bill::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ]);

        $result = $query
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->where('appointments.patient_id', '=', $patientId)
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $bill = Bill::select()
            ->where('bills.id', '=', $id)
            ->firstOrFail();

        return $bill;
    }

    public function findByPatientId($patientId)
    {
        $bills = Bill::select(
            'bills.*')
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->where('appointments.patient_id', '=', $patientId)
            ->paginate(15);

        return $bills;
    }

    public function findByAppointmentId($appointmentId)
    {
        $bills = Bill::select()
            ->where('bills.appointment_id', '=', $appointmentId)
            ->paginate(15);

        return $bills;
    }

    public function create(array $data) : Bill
    {
        try {
            $data['date'] = date("Y-m-d");
            $bill = Bill::create($data);

        } catch (ModelNotFoundException $e) {

        }
        catch (\Exception $e) {

        }

        return $bill;
    }

    public function update(array $data, Bill $bill): Bill
    {
        $bill->update($data);
        return $bill;
    }

    public function deleteById(int $id): void
    {
        $bill = Bill::find($id);
        $bill->delete();
    }
}
