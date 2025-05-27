<?php

namespace Database\Seeders;

use App\Models\DayOfWeek;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startTimes = ['08:00', '08:20', '08:40', '09:00', '09:20', '09:40',
            '10:00', '10:20', '10:40', '11:00', '11:20', '11:40', '12:00',
            '12:20', '12:40', '13:00', '13:20', '13:40'];

        $endTimes = ['08:20', '08:40', '09:00', '09:20', '09:40',
            '10:00', '10:20', '10:40', '11:00', '11:20', '11:40', '12:00',
            '12:20', '12:40', '13:00', '13:20', '13:40', '14:00'];

        $dentistsIds = Dentist::pluck('id');
        $dayOfWeekIds = DayOfWeek::pluck('id');

        foreach ($dentistsIds as $dentistId) {
            foreach ($dayOfWeekIds as $dayOfWeekId) {
                foreach ($startTimes as $index => $startTime) {
                    Schedule::create([
                        'dentist_id' => $dentistId,
                        'day_of_week_id' => $dayOfWeekId,
                        'start_time' => $startTime,
                        'end_time' => $endTimes[$index],
                    ]);
                }
            }
        }
    }
}
