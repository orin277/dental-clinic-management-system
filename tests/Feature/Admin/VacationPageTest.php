<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Vacation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VacationPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_page(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/vacations');

        $response->assertStatus(200);
    }

    public function test_create_vacation(): void
    {
        $admin = User::where('is_admin', true)->first();
        $vacation = Vacation::factory()->make();

        $response = $this->actingAs($admin)->post('admin/vacations', [
            'start' => $vacation->start,
            'end' => $vacation->end,
            'dentist_id' => 1,
        ]);

        $response->assertStatus(302);
    }

    public function test_update_vacation(): void
    {
        $admin = User::where('is_admin', true)->first();
        $vacation = Vacation::inRandomOrder()->first();

        $response = $this->actingAs($admin)->patch("admin/vacations/{$vacation->id}", [
            'dentist_id' => 2,
        ]);

        $response->assertStatus(302);
    }

    public function test_delete_vacation(): void
    {
        $admin = User::where('is_admin', true)->first();
        $vacation = Vacation::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/vacations/{$vacation->id}");

        $response->assertStatus(302);
    }
}
