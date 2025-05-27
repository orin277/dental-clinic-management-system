<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Payment;

class DashboardService
{
    public function getIncomeForCertainYear($year)
    {
        $monthlyPayments = Payment::selectRaw('MONTH(date) AS month, SUM(amount) AS total_amount')
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return $monthlyPayments;
    }

    public function getNumberOfVisitorsForCertainYear($year)
    {
        $monthlyAppointments = Appointment::selectRaw('MONTH(date) AS month, COUNT(*) AS total_appointments')
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return $monthlyAppointments;
    }

    public function getNumberOfVisitsToDentistForCertainYear($dentistId, $year)
    {
        $monthlyAppointments = Appointment::selectRaw('MONTH(date) AS month, COUNT(*) AS total_appointments')
            ->byDentistId($dentistId)
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return $monthlyAppointments;
    }

    public function getDentistIncomeForCertainYear($dentistId, $year)
    {
        $monthlyPayments = Payment::selectRaw('MONTH(payments.date) AS month, SUM(payments.amount) AS total_amount')
            ->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->byDentistId($dentistId)
            ->whereYear('payments.date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return $monthlyPayments;
    }

    public function getExpensesForLastTenYearsForPatient($patientId)
    {
        $last10Years = now()->subYears(10);

        $yearlyPayments = Payment::selectRaw('YEAR(payments.date) AS year, SUM(payments.amount) AS total_amount')
            ->join('bills', 'payments.bill_id', '=', 'bills.id')
            ->join('appointments', 'bills.appointment_id', '=', 'appointments.id')
            ->byPatientId($patientId)
            ->whereBetween('payments.date', [$last10Years, now()])
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        return $yearlyPayments;
    }

    public function getNumberOfVisitsInLastTenYearsForPatient($patientId)
    {
        $last10Years = now()->subYears(10);

        $yearlyAppointments = Appointment::selectRaw('YEAR(date) AS year, COUNT(*) AS total_appointments')
            ->byPatientId($patientId)
            ->whereBetween('date', [$last10Years, now()])
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        return $yearlyAppointments;
    }
}
