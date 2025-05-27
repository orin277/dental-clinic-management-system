<?php

namespace Database\Factories;

use App\Models\Bill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bill = Bill::all()->random();
        return [
            'appointment_id' => $bill->id,
            'amount' => $bill->amount,
            'date' => $bill->date,
        ];
    }
}
