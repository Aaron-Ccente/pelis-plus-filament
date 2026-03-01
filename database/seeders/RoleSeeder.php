<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            [
                'display_name' => 'Crear usuarios',
                'name' => 'crear.usuarios',
                'guard_name' => 'web',
            ],
            [
                'display_name' => 'Editar usuarios',
                'name' => 'editar.usuarios',
                'guard_name' => 'web',
            ],
            [
                'display_name' => 'Ver usuarios',
                'name' => 'ver.usuarios',
                'guard_name' => 'web',
            ],
            [
                'display_name' => 'Eliminar usuarios',
                'name' => 'eliminar.usuarios',
                'guard_name' => 'web',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }

        $adminRole = Role::firstOrCreate([
            ['name' => 'admin'],
            ['name' => 'gestor.usuarios'],
            ]);

        Role::firstOrCreate(['name' => 'user']);

        // Asignar permisos por nombre
        $adminRole->givePermissionTo([
            'crear.usuarios',
            'editar.usuarios',
            'ver.usuarios',
            'eliminar.usuarios',
        ]);
    }
}