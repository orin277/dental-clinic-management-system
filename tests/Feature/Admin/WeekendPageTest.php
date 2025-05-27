<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Weekend;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeekendPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_page(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/weekends');

        $response->assertStatus(200);
    }

    public function test_create_weekend(): void
    {
        $admin = User::where('is_admin', true)->first();
        $weekend = Weekend::factory()->make();

        $response = $this->actingAs($admin)->post('admin/weekends', [
            'day' => $weekend->day,
        ]);

        $response->assertStatus(302);
    }

    public function test_update_weekend(): void
    {
        $admin = User::where('is_admin', true)->first();
        $weekend = Weekend::inRandomOrder()->first();

        $response = $this->actingAs($admin)->patch("admin/weekends/{$weekend->id}", [
            'day' => '03-12-2024',
        ]);

        $response->assertStatus(302);
    }

    public function test_delete_weekend(): void
    {
        $admin = User::where('is_admin', true)->first();
        $weekend = Weekend::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/weekends/{$weekend->id}");

        $response->assertStatus(302);
    }
}
