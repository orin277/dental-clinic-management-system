<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $phoneStart = ['96', '93', '67', '98'];
        $phoneNumber = '+380' . fake()->randomElement($phoneStart) . fake()->randomNumber(7, true);
        $email = fake()->unique()->safeEmail();
//        while (User::where('email', $email)->exists()) {
//            $email = fake()->unique()->safeEmail();
//        }

        return [
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'patronymic' => fake()->middleName(),
            'date_of_birth' => fake()->dateTimeBetween(startDate: '-70 years', endDate: '-15 years'),
            'phone' => $phoneNumber,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('Password123'),
            'remember_token' => Str::random(10),
        ];
    }

    public function withSex($sex): UserFactory
    {
        return $this->state(function (array $attributes) use ($sex) {
            return [
                'name' => fake()->firstName($sex),
                'surname' => fake()->lastName($sex),
                'patronymic' => fake()->middleName($sex),
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
