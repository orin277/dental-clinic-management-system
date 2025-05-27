<?php

namespace Tests\Feature\Admin;

use App\Models\Treatment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TreatmentPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_page(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/treatments');

        $response->assertStatus(200);
    }

    public function test_create_treatment(): void
    {
        $admin = User::where('is_admin', true)->first();
        $treatment = Treatment::factory()->make();

        $response = $this->actingAs($admin)->post('admin/treatments', [
            'diagnosis' => $treatment->diagnosis,
            'treatment_description' => $treatment->treatment_description,
            'appointment_id' => 1,
            'tooth_id' => 1,
        ]);

        $response->assertStatus(302);
    }

    public function test_update_treatment(): void
    {
        $admin = User::where('is_admin', true)->first();
        $treatment = Treatment::inRandomOrder()->first();

        $response = $this->actingAs($admin)->patch("admin/treatments/{$treatment->id}", [
            'diagnosis' => 'new diagnosis',
        ]);

        $response->assertStatus(302);
    }

    public function test_delete_treatment(): void
    {
        $admin = User::where('is_admin', true)->first();
        $treatment = Treatment::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/treatments/{$treatment->id}");

        $response->assertStatus(302);
    }
}
