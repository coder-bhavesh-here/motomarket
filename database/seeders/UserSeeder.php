<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('Admin@123'),
            'role' => User::ROLE_ADMIN
        ]);

        User::create([
            'name' => 'Agency User',
            'email' => 'agency@example.com',
            'password' => bcrypt('Agency@123'),
            'role' => User::ROLE_AGENCY,
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('User@123'),
            'role' => User::ROLE_USER,
        ]);
    }
}
