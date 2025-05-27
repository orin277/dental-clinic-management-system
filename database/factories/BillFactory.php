<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $appointment = Appointment::where('appointment_status_id', 4)->get()->random();
        return [
            'appointment_id' => $appointment->id,
            'amount' => fake()->numberBetween(200, 3000),
            'date' => $appointment->date,
        ];
    }
}
