<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

   
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        // Create Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@ecohub.kz'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('super-admin');

        // Create Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@ecohub.kz'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // Create Moderator
        $moderator = User::updateOrCreate(
            ['email' => 'moderator@ecohub.kz'],
            [
                'name' => 'Moderator User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $moderator->assignRole('moderator');

        // Create Regular User
        $user = User::updateOrCreate(
            ['email' => 'user@ecohub.kz'],
            [
                'name' => 'Eco User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $user->assignRole('user');
    }
}
