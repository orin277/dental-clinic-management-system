<?php

namespace Tests\Feature\Admin;

use App\Models\Education;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EducationPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_page(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/educations');

        $response->assertStatus(200);
    }

    public function test_create_education(): void
    {
        $admin = User::where('is_admin', true)->first();
        $education = Education::factory()->make();

        $response = $this->actingAs($admin)->post('admin/educations', [
            'name_of_institution' => $education->name_of_institution,
            'graduation_year' => $education->graduation_year,
            'dentist_id' => 1
        ]);

        $response->assertStatus(302);
    }

    public function test_update_education(): void
    {
        $admin = User::where('is_admin', true)->first();
        $education = Education::inRandomOrder()->first();

        $response = $this->actingAs($admin)->patch("admin/educations/{$education->id}", [
            'graduation_year' => 1994,
        ]);

        $response->assertStatus(302);
    }

    public function test_delete_education(): void
    {
        $admin = User::where('is_admin', true)->first();
        $education = Education::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/educations/{$education->id}");

        $response->assertStatus(302);
    }
}
