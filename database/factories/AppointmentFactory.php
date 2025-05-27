<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\Dentist;
use App\Models\DentistSpecialization;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTimes = ['08:00', '08:20', '08:40', '09:00', '09:20', '09:40',
            '10:00', '10:20', '10:40', '11:00', '11:20', '11:40', '12:00',
            '12:20', '12:40', '13:00', '13:20', '13:40'];

        $endTimes = ['08:20', '08:40', '09:00', '09:20', '09:40',
            '10:00', '10:20', '10:40', '11:00', '11:20', '11:40', '12:00',
            '12:20', '12:40', '13:00', '13:20', '13:40', '14:00'];

        $randomIndex = array_rand($startTimes);

        $startTime = $startTimes[$randomIndex];
        $endTime = $endTimes[$randomIndex];
        $randomDate = fake()->dateTimeBetween(startDate: '-8 days');
        $dentist = Dentist::all()->random();
        $appointmentStatusId = AppointmentStatus::all()->random()->id;

//        while (Appointment::where('date', $randomDate)
//            ->where('dentist_id', $dentist->id)
//            ->where('start_time', $startTime)
//            ->where('end_time', $endTime)
//            ->exists()) {
//            $dentist = Dentist::all()->random();
//            $randomDate = fake()->dateTimeBetween(startDate: '-8 days');
//            $randomIndex = array_rand($startTimes);
//            $startTime = $startTimes[$randomIndex];
//            $endTime = $endTimes[$randomIndex];
//        }

        return [
            'dentist_id' => $dentist->id,
            'patient_id' => Patient::all()->random()->id,
            'appointment_status_id' => $appointmentStatusId,
            'cabinet' => $dentist->cabinet,
            'reason' => fake()->text,
            'date' => $randomDate,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }

    public function withReason($reason): AppointmentFactory
    {
        return $this->state(function (array $attributes) use ($reason) {
            return [
                'reason' => $reason,
            ];
        });
    }

    public function withDate($date): AppointmentFactory
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'date' => $date,
            ];
        });
    }

    public function withDentistId($date): AppointmentFactory
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'dentist_id' => $date,
            ];
        });
    }

    public function withStartTime($date): AppointmentFactory
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'start_time' => $date,
            ];
        });
    }

    public function withEndTime($date): AppointmentFactory
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'end_time' => $date,
            ];
        });
    }

    private function getRandomDate()
    {
        $currentDate = Carbon::now();
        $futureDate = $currentDate->copy()->addDays(30);
        return $currentDate->copy()->addDays(rand(0, $futureDate->diffInDays($currentDate)));
    }
}
