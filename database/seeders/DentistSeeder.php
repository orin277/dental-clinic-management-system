<?php

namespace Database\Seeders;

use App\Models\Dentist;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DentistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dentists = Dentist::factory()
            ->count(12)
            ->create();

        foreach ($dentists as $dentist) {
            $dentist->user->assignRole('dentist');
        }
    }
}
