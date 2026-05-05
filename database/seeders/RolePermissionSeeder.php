<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'create eco-projects', 'edit eco-projects', 'delete eco-projects', 'publish eco-projects', 'view eco-projects',
            'create eco-events', 'edit eco-events', 'delete eco-events', 'publish eco-events', 'view eco-events',
            'create reports', 'edit reports', 'delete reports', 'view reports',
            'manage users', 'manage roles', 'view analytics', 'manage settings'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles and Assign Permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->syncPermissions(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions([
            'create eco-projects', 'edit eco-projects', 'delete eco-projects', 'publish eco-projects', 'view eco-projects',
            'create eco-events', 'edit eco-events', 'delete eco-events', 'publish eco-events', 'view eco-events',
            'create reports', 'edit reports', 'delete reports', 'view reports', 'view analytics',
        ]);

        $moderator = Role::firstOrCreate(['name' => 'moderator']);
        $moderator->syncPermissions([
            'create eco-projects', 'edit eco-projects', 'publish eco-projects', 'view eco-projects',
            'create eco-events', 'edit eco-events', 'publish eco-events', 'view eco-events',
            'create reports', 'edit reports', 'view reports',
        ]);

        $user = Role::firstOrCreate(['name' => 'user']);
        $user->syncPermissions([
            'view eco-projects', 'view eco-events', 'create reports', 'view reports',
        ]);
    }
}
