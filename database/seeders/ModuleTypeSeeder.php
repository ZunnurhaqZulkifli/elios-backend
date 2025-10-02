<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Laravel CRUD', 
                'weight' => 5.00, 
            ],
            [
                'name' => 'Laravel CRUD + Api', 
                'weight' => 5.00, 
            ],
        ];

        foreach ($types as $type) {
            \App\Models\ModuleType::create($type);
        }
    }
}
