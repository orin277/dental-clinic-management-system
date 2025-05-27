<?php

namespace Database\Factories;

use App\Models\DayOfWeek;
use App\Models\Dentist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacation>
 */
class VacationFactory extends Factory
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
            'start' => fake()->date,
            'end' => fake()->date,
        ];
    }
}
