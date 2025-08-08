<?php
// database/seeders/RolesAndPermissionsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1) all your permissions…
        $permissions = [
            // dashboard
            'view dashboard',

            // users
            'create users', 'view users', 'edit users', 'delete users',

            // roles
            'create roles', 'view roles', 'edit roles', 'delete roles',

            // permissions
            'create permissions', 'view permissions', 'edit permissions', 'delete permissions',

            // codes
            'create codes', 'view codes', 'edit codes', 'delete codes',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 2) define roles & assign permissions
        $roles = [
            'Admin' => Permission::all()->pluck('name')->toArray(),

            'Cashier' => array_merge(
                ['view dashboard', 'view users'],
                [
                    'create codes', 'view codes', 'edit codes', 'delete codes',
                ]
            ),
        ];

        foreach ($roles as $name => $perms) {
            $role = Role::firstOrCreate(['name' => $name]);
            $role->syncPermissions($perms);
        }
    }
}
