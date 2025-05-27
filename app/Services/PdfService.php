<?php

namespace App\Services;

use App\Http\Filters\FiltersAppointmentSearch;
use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Treatment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PdfService
{
    public function generatePdfInformationAboutAppointment($appointmentId)
    {
        $fields = ['user_patients.name as patient_name',
            'user_patients.surname as patient_surname',
            'user_patients.patronymic as patient_patronymic',
            'user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'dentists.cabinet',
            'dentist_specializations.name as dentist_specialization_name',
            'appointments.date', 'appointments.start_time', 'appointments.end_time',
            'appointments.id', 'appointments.reason'];

        $data = Appointment::select($fields)
            ->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->byId($appointmentId)
            ->get()->toArray();

        $pdf = PDF::loadView('dentist/report/information-about-appointment', ['data' => $data]);

        return $pdf;
    }

    public function generatePdfInformationAboutTreatment($appointmentId)
    {
        $fields = ['user_patients.name as patient_name',
            'user_patients.surname as patient_surname',
            'user_patients.patronymic as patient_patronymic',
            'user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'dentist_specializations.name as dentist_specialization_name',
            'appointments.id as appointment_id', 'appointments.date',
            'treatments.id', 'treatments.diagnosis', 'treatment_description',
            'teeth.number as tooth_number'];

        $data = Treatment::select($fields)
            ->join('appointments', 'treatments.appointment_id', '=', 'appointments.id')
            ->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->join('teeth', 'treatments.tooth_id', '=', 'teeth.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->byAppointmentId($appointmentId)
            ->get()->toArray();

        $pdf = PDF::loadView('dentist/report/information-about-treatment', ['data' => $data]);

        return $pdf;
    }

    public function generatePdfInformationAboutBills($appointmentId)
    {
        $fields = ['user_patients.name as patient_name',
            'user_patients.surname as patient_surname',
            'user_patients.patronymic as patient_patronymic',
            'user_dentists.name as dentist_name',
            'user_dentists.surname as dentist_surname',
            'user_dentists.patronymic as dentist_patronymic',
            'dentist_specializations.name as dentist_specialization_name',
            'appointments.id as appointment_id', 'appointments.date as appointment_date',
            'bills.id as bill_id', 'bills.amount', 'bills.date'];

        $data = Bill::select($fields)
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->join('dentists', 'appointments.dentist_id', '=', 'dentists.id')
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as user_patients', 'patients.user_id', '=', 'user_patients.id')
            ->join('users as user_dentists', 'dentists.user_id', '=', 'user_dentists.id')
            ->join('dentist_specializations', 'dentists.dentist_specialization_id', '=', 'dentist_specializations.id')
            ->byAppointmentId($appointmentId)
            ->get()->toArray();

        $pdf = PDF::loadView('dentist/report/information-about-bills', ['data' => $data]);

        return $pdf;
    }

    public function generatePdfIncomeForCertainYear($year)
    {
        $data = Payment::selectRaw('MONTH(date) AS month, SUM(amount) AS total_amount')
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $this->setNamesForMonths($data);

        $totalIncome = 0;
        foreach ($data as $record) {
            $totalIncome += $record['total_amount'];
        }

        $pdf = PDF::loadView('admin/report/income-for-certain-year',
            ['data' => $data, 'year' => $year, 'totalIncome' => $totalIncome]);

        return $pdf;
    }

    public function generatePdfNumberOfVisitorsForCertainYear($year)
    {
        $data = Appointment::selectRaw('MONTH(date) AS month, COUNT(*) AS total_appointments')
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $this->setNamesForMonths($data);

        $totalNumberOfVisitors = 0;
        foreach ($data as $record) {
            $totalNumberOfVisitors += $record['total_appointments'];
        }

        $pdf = PDF::loadView('admin/report/number-of-visitors-for-certain-year',
            ['data' => $data, 'year' => $year, 'totalNumberOfVisitors' => $totalNumberOfVisitors]);

        return $pdf;
    }

    public function generatePdfNumberOfVisitsToDentistForCertainYear($dentist, $year)
    {
        $data = Appointment::selectRaw('MONTH(date) AS month, COUNT(*) AS total_appointments')
            ->byDentistId($dentist->id)
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $this->setNamesForMonths($data);

        $totalNumberOfVisitors = 0;
        foreach ($data as $record) {
            $totalNumberOfVisitors += $record['total_appointments'];
        }

        $pdf = PDF::loadView('dentist/report/number-of-visits-to-dentist-for-certain-year',
            ['data' => $data, 'year' => $year, 'totalNumberOfVisitors' => $totalNumberOfVisitors, 'dentist' => $dentist]);

        return $pdf;
    }

    public function generatePdfDentistIncomeForCertainYear($dentist, $year)
    {
        $data = Payment::selectRaw('MONTH(payments.date) AS month, SUM(payments.amount) AS total_amount')
            ->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->byDentistId($dentist->id)
            ->whereYear('payments.date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $this->setNamesForMonths($data);

        $totalIncome = 0;
        foreach ($data as $record) {
            $totalIncome += $record['total_amount'];
        }

        $pdf = PDF::loadView('dentist/report/income-for-certain-year',
            ['data' => $data, 'year' => $year, 'totalIncome' => $totalIncome, 'dentist' => $dentist]);

        return $pdf;
    }

    public function generatePdfExpensesForLastTenYearsForPatient($patient)
    {
        $lastTenYears = now()->subYears(10);

        $data = Payment::selectRaw('YEAR(payments.date) AS year, SUM(payments.amount) AS total_amount')
            ->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->byPatientId($patient->id)
            ->whereBetween('payments.date', [$lastTenYears, now()])
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $totalAmount = 0;
        foreach ($data as $record) {
            $totalAmount += $record['total_amount'];
        }

        $pdf = PDF::loadView('patient/report/expenses-for-last-ten-years',
            ['data' => $data, 'lastTenYears' => $lastTenYears,
                'patient' => $patient, 'totalAmount' => $totalAmount]);

        return $pdf;
    }

    public function generatePdfNumberOfVisitsInLastTenYearsForPatient($patient)
    {
        $lastTenYears = now()->subYears(10);

        $data = Appointment::selectRaw('YEAR(date) AS year, COUNT(*) AS total_appointments')
            ->byPatientId($patient->id)
            ->whereBetween('date', [$lastTenYears, now()])
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $totalAppointments = 0;
        foreach ($data as $record) {
            $totalAppointments += $record['total_appointments'];
        }

        $pdf = PDF::loadView('patient/report/number-of-visits-in-last-ten-years',
            ['data' => $data, 'lastTenYears' => $lastTenYears,
                'patient' => $patient, 'totalAppointments' => $totalAppointments]);

        return $pdf;
    }

    private function setNamesForMonths($data)
    {
        $months = [
            1 => 'Січень', 2 => 'Лютий', 3 => 'Березень',
            4 => 'Квітень', 5 => 'Травень', 6 => 'Червень',
            7 => 'Липень', 8 => 'Серпень', 9 => 'Вересень',
            10 => 'Жовтень', 11 => 'Листопад', 12 => 'Грудень'
        ];

        foreach ($data as &$record) {
            $monthNumber = $record['month'];
            if (isset($months[$monthNumber])) {
                $record['month'] = $months[$monthNumber];
            }
        }
    }
}
