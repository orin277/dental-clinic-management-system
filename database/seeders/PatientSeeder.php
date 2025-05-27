<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::factory()
            ->count(1000)
            ->create();

        foreach ($patients as $patient) {
            $patient->user->assignRole('patient');
        }
    }
}
