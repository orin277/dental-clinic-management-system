<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Tooth;
use App\Models\Treatment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Treatment::factory()
            ->count(300)
            ->create();
    }
}
