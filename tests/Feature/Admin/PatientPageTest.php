<?php

namespace Tests\Feature\Admin;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_patients(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/patients');

        $response->assertStatus(200);
    }

    public function test_create_patient(): void
    {
        $admin = User::where('is_admin', true)->first();
        $user = User::factory()->make();

        $response = $this->actingAs($admin)->post('admin/patients', [
            'name' => $user->name,
            'surname' => $user->surname,
            'patronymic' => $user->patronymic,
            'phone' => $user->phone,
            'date_of_birth' => $user->date_of_birth->format('Y-m-d'),
            'email' => $user->email,
            'password' => $user->password,
            'address' => 'address',
            'sex' => 1,
            'allergies' => 'example',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    public function test_update_patient(): void
    {
        $admin = User::where('is_admin', true)->first();
        $patient = Patient::inRandomOrder()->first();
        $user = User::find($patient->user_id);

        $response = $this->actingAs($admin)->patch("admin/patients/{$patient->id}", [
            'name' => 'Олена',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Олена',
        ]);
    }

    public function test_delete_patient(): void
    {
        $admin = User::where('is_admin', true)->first();
        $patient = Patient::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/patients/{$patient->id}");

        $response->assertStatus(302);
    }
}
