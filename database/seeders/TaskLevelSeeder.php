<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'name' => 'Easy', 
                'weight' => 5.00, 
            ],
            [
                'name' => 'Medium', 
                'weight' => 5.00, 
            ],
            [
                'name' => 'Hard', 
                'weight' => 5.00, 
            ],
        ];

        foreach ($levels as $type) {
            \App\Models\TaskType::create($type);
        }
    }
}
