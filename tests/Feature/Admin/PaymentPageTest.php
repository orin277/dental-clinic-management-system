<?php

namespace Tests\Feature\Admin;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_page(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/payments');

        $response->assertStatus(200);
    }

    public function test_create_payment(): void
    {
        $admin = User::where('is_admin', true)->first();
        $payment = Payment::factory()->make();

        $response = $this->actingAs($admin)->post('admin/payments', [
            'amount' => $payment->amount,
            'date' => $payment->date,
            'bill_id' => 1,
        ]);

        $response->assertStatus(302);
    }

    public function test_update_payment(): void
    {
        $admin = User::where('is_admin', true)->first();
        $payment = Payment::inRandomOrder()->first();

        $response = $this->actingAs($admin)->patch("admin/payments/{$payment->id}", [
            'amount' => 400,
        ]);

        $response->assertStatus(302);
    }

    public function test_delete_payment(): void
    {
        $admin = User::where('is_admin', true)->first();
        $payment = Payment::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/payments/{$payment->id}");

        $response->assertStatus(302);
    }
}
