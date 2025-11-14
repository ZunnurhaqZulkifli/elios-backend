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
            [
                'name' => 'admin' ,
                'display_name' => 'Admin', 
                'status' => 'active'
            ],
            [
                'name' => 'manager' ,
                'display_name' => 'Manager', 
                'status' => 'active'
            ],
            [
                'name' => 'user' ,
                'display_name' => 'User', 
                'status' => 'active'
            ],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
    }
}
