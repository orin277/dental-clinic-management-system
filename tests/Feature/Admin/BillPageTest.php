<?php

namespace Tests\Feature\Admin;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BillPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_page(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/bills');

        $response->assertStatus(200);
    }

    public function test_create_bill(): void
    {
        $admin = User::where('is_admin', true)->first();
        $bill = Bill::factory()->make();

        $response = $this->actingAs($admin)->post('admin/bills', [
            'amount' => $bill->amount,
            'date' => $bill->date,
            'appointment_id' => 1,
        ]);

        $response->assertStatus(302);
    }

    public function test_update_bill(): void
    {
        $admin = User::where('is_admin', true)->first();
        $bill = Bill::inRandomOrder()->first();

        $response = $this->actingAs($admin)->patch("admin/bills/{$bill->id}", [
            'amount' => 400,
        ]);

        $response->assertStatus(302);
    }

    public function test_delete_bill(): void
    {
        $admin = User::where('is_admin', true)->first();
        $bill = Bill::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/bills/{$bill->id}");

        $response->assertStatus(302);
    }
}
