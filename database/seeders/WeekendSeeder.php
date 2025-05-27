<?php

namespace Database\Seeders;

use App\Models\Weekend;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeekendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weekends = ['2024-01-01', '2024-01-07', '2024-03-08', '2024-04-07', '2024-04-28', '2024-05-01',
            '2024-05-02', '2024-05-09', '2024-06-16', '2024-06-28', '2024-08-24', '2024-10-14', '2024-12-25'];

        foreach ($weekends as $weekend) {
            Weekend::create([
                'day' => $weekend,
            ]);
        }
    }
}
