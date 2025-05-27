<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Tooth;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $treatments = [
            [
                'reason' => 'Біль при їжі',
                'diagnosis' => 'Пульпіт',
                'treatment_description' => 'Проведено пломбування зуба',
            ],
            [
                'reason' => 'Виражений біль при натисканні на зуб',
                'diagnosis' => 'Пульпіт',
                'treatment_description' => 'Проведено ендодонтичне лікування',
            ],
            [
                'reason' => 'Відсутність частини зуба',
                'diagnosis' => 'Травма зуба',
                'treatment_description' => 'Проведено реставрацію зуба',
            ],
            [
                'reason' => 'Травма внаслідок удару',
                'diagnosis' => 'Перелом кореня зуба',
                'treatment_description' => 'Проведено резекцію кореня',
            ],
            [
                'reason' => 'Постійний біль у правому верхньому кутньому зубі',
                'diagnosis' => 'Пульпіт',
                'treatment_description' => 'Проведено ендодонтичне лікування та пломбування каналів',
            ],
            [
                'reason' => 'Ниючий біль у зубі, що посилюється при жуванні',
                'diagnosis' => 'Періодонтит',
                'treatment_description' => 'Проведено ендодонтичне лікування та пломбування каналів',
            ],
            [
                'reason' => 'болючі відчуття під час пережовування їжі та вживання напоїв',
                'diagnosis' => 'Періодонтальна кіста',
                'treatment_description' => 'Проведено хірургічне видалення кісти та відновлення кісткової тканини',
            ],
            [
                'reason' => 'Чутливість до холодного та гарячого',
                'diagnosis' => 'Ерозія емалі',
                'treatment_description' => 'Проведено фторування',
            ],

        ];

        $treatment = fake()->randomElement($treatments);

        return [
            'diagnosis' => $treatment['diagnosis'],
            'treatment_description' => $treatment['treatment_description'],
            'appointment_id' => Appointment::all()->random()->id,
            'tooth_id' => Tooth::all()->random()->id,
        ];
    }

    public function withDiagnosis($diagnosis): TreatmentFactory
    {
        return $this->state(function (array $attributes) use ($diagnosis) {
            return [
                'diagnosis' => $diagnosis,
            ];
        });
    }

    public function withTreatmentDescription($treatmentDescription): TreatmentFactory
    {
        return $this->state(function (array $attributes) use ($treatmentDescription) {
            return [
                'treatment_description' => $treatmentDescription,
            ];
        });
    }

    public function withAppointmentId($appointmentId): TreatmentFactory
    {
        return $this->state(function (array $attributes) use ($appointmentId) {
            return [
                'appointment_id' => $appointmentId,
            ];
        });
    }
}
