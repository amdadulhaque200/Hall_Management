<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'student']);

        // Create admin user
        $admin = User::create([
            'name'     => 'Hall Admin',
            'email'    => 'admin@hall.com',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('admin');
    }
}