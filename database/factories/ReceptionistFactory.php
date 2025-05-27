<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receptionist>
 */
class ReceptionistFactory extends Factory
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
            'user_id' => User::factory()->withSex($sex),
            'address' => fake()->address,
            'sex' => $sexId,
        ];
    }
}
