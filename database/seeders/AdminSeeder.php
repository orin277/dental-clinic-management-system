<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Володимир',
            'surname' => 'Кравченко',
            'patronymic' => 'Олексійович',
            'date_of_birth' => '2000-03-04',
            'phone' => '+380678593058',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        $user->assignRole('admin');
    }
}
