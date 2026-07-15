<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario Admin por defecto
        $adminRole = Role::where('name', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@footwearpoint.mx'],
            [
                'name' => 'Administrador Principal',
                'password' => Hash::make('password123'),
                'role_id' => $adminRole->id,
            ]
        );

        // Opcional: Crear algunos usuarios de prueba
        User::firstOrCreate(
            ['email' => 'distribuidora@footwearpoint.mx'],
            [
                'name' => 'Distribuidora Test',
                'password' => Hash::make('password123'),
                'role_id' => Role::where('name', 'distribuidora')->first()->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'mayorista@footwearpoint.mx'],
            [
                'name' => 'Mayorista Test',
                'password' => Hash::make('password123'),
                'role_id' => Role::where('name', 'mayorista')->first()->id,
            ]
        );
    }
}