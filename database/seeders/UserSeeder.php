<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Ensure to import the User model
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Check if the admin user already exists
        if (!User::where('email', 'admin@pulsa.id')->exists()) {
            // Create Super Admin user
            $admin = User::create([
                'name' => 'Super Admin',
                'email' => 'admin@pulsa.id',
                'password' => Hash::make('password'), // Hash the password
            ]);
            if (method_exists($admin, 'assignRole')) {
                $admin->assignRole('super-admin');
            } else {
                $role = Role::firstWhere('name', 'super-admin');
                if ($role) {
                    $admin->roles()->attach($role->id);
                }
            }
        }

        // Check if the staff user already exists
        if (!User::where('email', 'staff@pulsa.id')->exists()) {
            // Create Staff user
            $staff = User::create([
                'name' => 'Staff User',
                'email' => 'staff@pulsa.id',
                'password' => Hash::make('password'), // Hash the password
            ]);
            if (method_exists($staff, 'assignRole')) {
                $staff->assignRole('staff');
            } else {
                $role = Role::firstWhere('name', 'staff');
                if ($role) {
                    $staff->roles()->attach($role->id);
                }
            }
        }
    }
}
