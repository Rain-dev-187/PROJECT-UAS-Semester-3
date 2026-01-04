<?php
// scripts/reset_demo_users.php
// Usage: php scripts/reset_demo_users.php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Bootstrap the application (console kernel) so we can use Eloquent and facades
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$accounts = [
    ['name' => 'Super Admin', 'email' => 'admin@pulsa.id', 'password' => 'password', 'role' => 'super-admin'],
    ['name' => 'Staff Editor', 'email' => 'staff@pulsa.id', 'password' => 'password', 'role' => 'staff'],
    ['name' => 'Public User', 'email' => 'user@pulsa.id', 'password' => 'password', 'role' => 'public'],
];

foreach ($accounts as $acc) {
    $user = User::where('email', $acc['email'])->first();
    if ($user) {
        $user->password = Hash::make($acc['password']);
        $user->name = $acc['name'];
        $user->save();
        echo "Updated user: {$acc['email']}\n";
    } else {
        $user = User::create([
            'name' => $acc['name'],
            'email' => $acc['email'],
            'password' => Hash::make($acc['password']),
        ]);
        echo "Created user: {$acc['email']} (id={$user->id})\n";
    }

    // Try to assign role if Spatie exists and Role model is available
    if (class_exists(\Spatie\Permission\Models\Role::class) && method_exists($user, 'assignRole')) {
        try {
            $user->assignRole($acc['role']);
            echo "-> Role assigned: {$acc['role']}\n";
        } catch (Exception $e) {
            echo "-> Role assign failed: " . $e->getMessage() . "\n";
        }
    }

    echo "----------------------------\n";
}

echo "Done. Login with admin@pulsa.id / password\n";
