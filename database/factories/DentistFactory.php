<?php

namespace Database\Factories;

use App\Models\DentistSpecialization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dentist>
 */
class DentistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sex = fake()->randomElement(['male', 'female']);
        $sexId = $sex === 'male' ? 1 : 2;

        return [
            'cabinet' => fake()->numberBetween(1, 100),
            'dentist_specialization_id' => DentistSpecialization::all()->random()->id,
            'work_experience' => fake()->numberBetween(1, 45),
            'user_id' => User::factory()->withSex($sex),
            'address' => fake()->address,
            'sex' => $sexId,
        ];
    }
}
