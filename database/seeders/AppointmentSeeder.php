<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Treatment;
use Carbon\Carbon;
use Database\Factories\TreatmentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
                'reason' => 'Ниючий біль у зубі, що посилюється при жуванні.',
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

        $startTimes = ['08:00', '08:20', '08:40', '09:00', '09:20', '09:40',
            '10:00', '10:20', '10:40', '11:00', '11:20', '11:40', '12:00',
            '12:20', '12:40', '13:00', '13:20', '13:40'];

        $endTimes = ['08:20', '08:40', '09:00', '09:20', '09:40',
            '10:00', '10:20', '10:40', '11:00', '11:20', '11:40', '12:00',
            '12:20', '12:40', '13:00', '13:20', '13:40', '14:00'];

        $treatment = fake()->randomElement($treatments);

        $dates = $this->getAllDatesOfYear(2024);
        $dentists = Dentist::all();
        $dates = array_slice($dates, 0, 200);

        foreach ($dentists as $dentist) {
            foreach ($dates as $date) {
                for ($i = 0; $i < count($startTimes); $i++) {
                    $appointment = Appointment::factory()
                        ->withDentistId($dentist->id)
                        ->withDate($date)
                        ->withStartTime($startTimes[$i])
                        ->withEndTime($endTimes[$i])
                        ->withReason($treatment['reason'])
                        ->create();

                    if ($appointment->appointment_status_id === 4) {
                        Treatment::factory()
                            ->withDiagnosis($treatment['diagnosis'])
                            ->withTreatmentDescription($treatment['treatment_description'])
                            ->withAppointmentId($appointment->id)
                            ->create();
                    }
                }

            }
            dump(123);
        }
    }

    function getAllDatesOfYear($year)
    {
        $dates = [];
        $startDate = Carbon::createFromDate($year, 1, 1);
        $endDate = Carbon::createFromDate($year, 12, 31);

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dates[] = $date->toDateString();
        }

        return $dates;
    }
}
