<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Receptionist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $receptionists = Receptionist::factory()
            ->count(2)
            ->create();

        foreach ($receptionists as $receptionist) {
            $receptionist->user->assignRole('receptionist');
        }
    }
}
