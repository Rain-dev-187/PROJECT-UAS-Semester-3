<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions used across the admin area (match blade @can checks)
        $permissions = [
            'manage berita',
            'manage opini',
            'manage suara',
            'manage team',
            'manage users',
            'view users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles: super-admin (full), Admin (limited), user/public (read-only)
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Assign permissions
        $superAdmin->givePermissionTo($permissions);
        // Admin can manage berita, opini, suara, and team but NOT users
        $adminRole->givePermissionTo(['manage berita', 'manage opini', 'manage suara', 'manage team']);
        // Guest gets no admin permissions (read-only on public site)
    }
}
