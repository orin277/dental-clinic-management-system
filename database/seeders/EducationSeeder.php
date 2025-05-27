<?php

namespace Database\Seeders;

use App\Models\Dentist;
use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dentistsIds = Dentist::pluck('id');

        foreach ($dentistsIds as $dentistId) {
            Education::factory()->withDentist($dentistId)->create();
        }
    }
}
