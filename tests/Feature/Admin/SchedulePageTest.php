<?php

namespace Tests\Feature\Admin;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchedulePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_page(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/schedules');

        $response->assertStatus(200);
    }

    public function test_create_schedule(): void
    {
        $admin = User::where('is_admin', true)->first();
        $schedule = Schedule::factory()->make();

        $response = $this->actingAs($admin)->post('admin/schedules', [
            'start_time' => $schedule->start_time,
            'end_time' => $schedule->end_time,
            'dentist_id' => 1,
            'day_of_week_id' => 1,
        ]);

        $response->assertStatus(302);
    }

    public function test_update_schedule(): void
    {
        $admin = User::where('is_admin', true)->first();
        $schedule = Schedule::inRandomOrder()->first();

        $response = $this->actingAs($admin)->patch("admin/schedules/{$schedule->id}", [
            'day_of_week_id' => 2,
        ]);

        $response->assertStatus(302);
    }

    public function test_delete_schedule(): void
    {
        $admin = User::where('is_admin', true)->first();
        $schedule = Schedule::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/schedules/{$schedule->id}");

        $response->assertStatus(302);
    }
}
