<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Database\Factories\PatientFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            AdminSeeder::class,
            DentistSeeder::class,
            ReceptionistSeeder::class,
            PatientSeeder::class,
            ScheduleSeeder::class,
            VacationSeeder::class,
            ToothSeeder::class,
            AppointmentSeeder::class,
            BillSeeder::class,
            PaymentSeeder::class,
            WeekendSeeder::class,
            EducationSeeder::class,
        ]);
    }
}
