<?php

namespace Database\Factories;

use App\Models\DayOfWeek;
use App\Models\Dentist;
use App\Models\DentistSpecialization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dentist_id' => Dentist::all()->random()->id,
            'day_of_week_id' => DayOfWeek::all()->random()->id,
            'start_time' => fake()->time,
            'end_time' => fake()->time,
        ];
    }
}
