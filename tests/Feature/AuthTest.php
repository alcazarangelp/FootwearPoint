<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_puede_acceder_a_dashboard()
{
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    
    $admin = User::factory()->create(['role_id' => $adminRole->id]);

    $response = $this->actingAs($admin)->get('/admin/dashboard');

    $response->assertStatus(200);
}

    public function test_minorista_no_puede_acceder_a_admin()
    {
        $minoristaRole = Role::firstOrCreate(['name' => 'minorista']);

        $minorista = User::factory()->create(['role_id' => $minoristaRole->id]);

        $response = $this->actingAs($minorista)->get('/admin/users');

        $response->assertStatus(403);
    }
}
