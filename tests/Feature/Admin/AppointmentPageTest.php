<?php

namespace Tests\Feature\Admin;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_page(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/appointments');

        $response->assertStatus(200);
    }

    public function test_create_appointment(): void
    {
        $admin = User::where('is_admin', true)->first();
        $appointment = Appointment::factory()->make();

        $response = $this->actingAs($admin)->post('admin/appointments', [
            'reason' => $appointment->reason,
            'cabinet' => $appointment->cabinet,
            'date' => $appointment->date->format('Y-m-d'),
            'start_time' => $appointment->start_time,
            'end_time' => $appointment->end_time,
            'dentist_id' => 1,
            'patient_id' => 1,
            'appointment_status_id' => 1,
        ]);

        $response->assertStatus(302);
    }

    public function test_update_appointment(): void
    {
        $admin = User::where('is_admin', true)->first();
        $appointment = Appointment::inRandomOrder()->first();

        $response = $this->actingAs($admin)->patch("admin/appointments/{$appointment->id}", [
            'reason' => 'new reason',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'reason' => 'new reason',
        ]);
    }

    public function test_delete_dentist(): void
    {
        $admin = User::where('is_admin', true)->first();
        $appointment = Appointment::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/appointments/{$appointment->id}");

        $response->assertStatus(302);
    }
}
