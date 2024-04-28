<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'admin']);

        $userPermission = Permission::create(['name' => 'user dashboard']);
        $adminPermission = Permission::create(['name' => 'admin dashboard']);

        $userRole->givePermissionTo($userPermission);
        $adminRole->givePermissionTo($adminPermission);

        // Create admin user with admin role assigned
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole($adminRole);

        // Create non-admin users and assign user role to them
        $users = User::factory(5)->create();
        $users->each(fn (User $user) => $user->assignRole($userRole));
    }
}
