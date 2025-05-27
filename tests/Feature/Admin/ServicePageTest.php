<?php

namespace Tests\Feature\Admin;

use App\Models\Schedule;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServicePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_page(): void
    {
        $admin = User::where('is_admin', true)->first();
        $response = $this->actingAs($admin)->get('admin/services');

        $response->assertStatus(200);
    }

    public function test_create_service(): void
    {
        $admin = User::where('is_admin', true)->first();
        $service = Service::factory()->make();

        $response = $this->actingAs($admin)->post('admin/services', [
            'name' => $service->name,
            'price' => $service->price,
            'type_of_service_id' => 1,
        ]);

        $response->assertStatus(302);
    }

    public function test_update_service(): void
    {
        $admin = User::where('is_admin', true)->first();
        $service = Service::inRandomOrder()->first();

        $response = $this->actingAs($admin)->patch("admin/services/{$service->id}", [
            'name' => 'new service',
        ]);

        $response->assertStatus(302);
    }

    public function test_delete_service(): void
    {
        $admin = User::where('is_admin', true)->first();
        $service = Service::inRandomOrder()->first();

        $response = $this->actingAs($admin)->delete("admin/services/{$service->id}");

        $response->assertStatus(302);
    }
}
