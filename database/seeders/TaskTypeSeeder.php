<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        TaskType::truncate();

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
            TaskType::create($type);
        }
    }
}
