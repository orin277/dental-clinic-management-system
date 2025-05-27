<?php

namespace Database\Seeders;

use App\Models\DayOfWeek;
use App\Models\Dentist;
use App\Models\Schedule;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now();
        $date2 = $date->copy()->addDays(20);
        $dentistsIds = Dentist::pluck('id');

        foreach ($dentistsIds as $dentistId) {
            Vacation::create([
                'dentist_id' => $dentistId,
                'start' => $date,
                'end' => $date2,
            ]);
            $date = $date->addDays(20);
            $date2 = $date2->addDays(20);
        }
    }
}
