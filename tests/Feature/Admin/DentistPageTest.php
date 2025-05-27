<?php

namespace Tests\Feature\Admin;

use App\Models\Dentist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DentistPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_page(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/dentists');

        $response->assertStatus(200);
    }

    public function test_create_dentist(): void
    {
        $admin = User::where('is_admin', true)->first();
        $user = User::factory()->make();

        $response = $this->actingAs($admin)->post('admin/dentists', [
            'name' => $user->name,
            'surname' => $user->surname,
            'patronymic' => $user->patronymic,
            'phone' => $user->phone,
            'date_of_birth' => $user->date_of_birth->format('Y-m-d'),
            'email' => $user->email,
            'password' => $user->password,
            'address' => 'address',
            'sex' => 1,
            'cabinet' => 10,
            'work_experience' => 10,
            'dentist_specialization_id' => 1,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    public function test_update_dentist(): void
    {
        $admin = User::where('is_admin', true)->first();
        $dentist = Dentist::inRandomOrder()->first();
        $user = User::find($dentist->user_id);

        $response = $this->actingAs($admin)->patch("admin/dentists/{$dentist->id}", [
            'name' => 'Олена',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Олена',
        ]);
    }

    public function test_delete_dentist(): void
    {
        $admin = User::where('is_admin', true)->first();
        $dentist = Dentist::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/dentists/{$dentist->id}");

        $response->assertStatus(302);
    }
}
