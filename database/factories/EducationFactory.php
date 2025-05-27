<?php

namespace Database\Factories;

use App\Models\Dentist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $institutions = ['Дніпровський державний медичний університет',
            'Вінницький національний медичний університет ім. Н. Пирогова',
            'Івано-Франківський національний медичний університет',
            'Запорізький державний медичний університет',
            'Тернопільський національний медичний університет ім. І Я. Горбачевського',
            'Буковинський державний медичний університет',
            'Львівський медичний університет',
            'Київський медичний університет',
            'Сумський державний університет',
            'Полтавський державний медичний університет',
            'Харківський національний медичний університет',
            'Дніпровський медичний інститут традиційної і нетрадиційної медицини',
            ];

        $currentYear = date('Y');
        $minYear = $currentYear - 40;

        $randomYear = fake()->numberBetween($minYear, $currentYear);

        return [
            'dentist_id' => Dentist::all()->random()->id,
            'name_of_institution' => fake()->randomElement($institutions),
            'graduation_year' => $randomYear,
        ];
    }

    public function withDentist($dentistId): EducationFactory
    {
        return $this->state(function (array $attributes) use ($dentistId) {
            return [
                'dentist_id' => $dentistId,
            ];
        });
    }
}
