<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Bug', 
                'weight' => 5.00, 
            ],
            [
                'name' => 'Fix', 
                'weight' => 5.00, 
            ],
            [
                'name' => 'New', 
                'weight' => 5.00, 
            ],
            [
                'name' => 'Feature', 
                'weight' => 3.00, 
            ],
            [
                'name' => 'Improvement', 
                'weight' => 2.00, 
            ],
        ];

        foreach ($types as $type) {
            \App\Models\TaskType::create($type);
        }
    }
}
