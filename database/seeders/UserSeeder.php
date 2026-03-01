<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear admin específico
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Aaron Ccente',
                'password' => Hash::make('admin123'),
            ]
        );

        $admin->assignRole('admin');

        // Crear usuario normal específico
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Usuario Normal',
                'password' => Hash::make('user1234'),
            ]
        );

        $user->assignRole('user');

    }
}