<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ConvertGuestRoleSeeder extends Seeder
{
    public function run(): void
    {
        // If a 'guest' role exists, convert it to 'user' unless 'user' already exists.
        $guest = Role::where('name', 'guest')->first();
        if ($guest) {
            $user = Role::where('name', 'user')->first();
            if (! $user) {
                $guest->name = 'user';
                $guest->save();
            } else {
                // If 'user' role already exists, remove the redundant 'guest' role
                $guest->delete();
            }
        }
    }
}
