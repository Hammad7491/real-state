<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Ensure roles exist
        $roles = ['Admin', 'Cashier', 'User'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
        }

        // — Admin User —
        $admin = User::updateOrCreate(
            ['email' => 'a@a'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('a'),
            ]
        );
        $admin->assignRole('Admin');

        // — Cashier User —
        $cashier = User::updateOrCreate(
            ['email' => 'cashier@example.com'],
            [
                'name'     => 'Cashier User',
                'password' => Hash::make('password'),
            ]
        );
        $cashier->assignRole('Cashier');

        // — Regular User —
        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name'     => 'Regular User',
                'password' => Hash::make('password'),
            ]
        );
        $user->assignRole('User');
    }
}
