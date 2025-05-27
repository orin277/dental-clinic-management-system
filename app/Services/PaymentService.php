<?php

namespace App\Services;

use App\Http\Filters\FiltersAppointmentSearch;
use App\Http\Filters\FiltersPaymentSearch;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentService
{
    public function findAll($fields = [], $paginate = true)
    {
        if (empty($fields)) {
            $fields = ['user_patients.name as patient_name',
                'user_patients.surname as patient_surname',
                'user_patients.patronymic as patient_patronymic',
                'payments.*'];
        }

        $query = QueryBuilder::for(Payment::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersPaymentSearch),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ]);

        $query = $query
            ->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id');

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
            'payments.id', 'payments.amount', 'payments.date', 'payments.bill_id'];

        $query = QueryBuilder::for(Payment::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::custom('search', new FiltersPaymentSearch),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ]);

        $result = $query
            ->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->paginate(15);

        return $result;
    }

    public function findAllForPatient($patientId)
    {
        $fields = ['payments.id', 'payments.amount',
            'payments.date', 'payments.bill_id'];

        $query = QueryBuilder::for(Payment::class)
            ->select($fields)
            ->allowedFilters([
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ]);

        $result = $query->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->where('appointments.patient_id', '=', $patientId)
            ->paginate(15);

        return $result;
    }

    public function findById($id)
    {
        $payment = Payment::select('user_patients.name as patient_name',
            'user_patients.surname as patient_surname',
            'user_patients.patronymic as patient_patronymic',
            'payments.*')
            ->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->where('payments.id', '=', $id)
            ->firstOrFail();

        return $payment;
    }

    public function findByPatientId($patientId)
    {
        $payments = Payment::select(
            'payments.id', 'payments.amount', 'payments.date', 'payments.bill_id')
            ->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->where('appointments.patient_id', '=', $patientId)
            ->paginate(15);

        return $payments;
    }

    public function create(array $data) : Payment
    {
        try {
            $payment = Payment::create($data);

        } catch (ModelNotFoundException $e) {

        }
        catch (\Exception $e) {

        }

        return $payment;
    }

    public function update(array $data, Payment $payment): Payment
    {
        $payment->update($data);
        return $payment;
    }

    public function deleteById(int $id): void
    {
        $payment = Payment::find($id);
        $payment->delete();
    }
}
