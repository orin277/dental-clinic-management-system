<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bills = Bill::all();
        foreach ($bills as $bill) {
            Payment::create([
                'bill_id' => $bill->id,
                'amount' => $bill->amount,
                'date' => $bill->date
            ]);
        }
    }
}
