<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'description' => 'Administrator with full access', 'status' => 'active'],
            ['name' => 'Manager', 'description' => 'Manager with elevated privileges', 'status' => 'active'],
            ['name' => 'User', 'description' => 'Regular user with standard access', 'status' => 'active'],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
    }
}
