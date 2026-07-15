<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'distribuidora'],
            ['name' => 'empleado'],
            ['name' => 'mayorista'],
            ['name' => 'minorista'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}