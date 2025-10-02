<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectBugSeveritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $severities = [
            [
                'name' => 'Low', 
                'weight' => 1.00, 
            ],
            [
                'name' => 'Medium', 
                'weight' => 3.00, 
            ],
            [
                'name' => 'High', 
                'weight' => 5.00, 
            ],
        ];

        foreach ($severities as $type) {
            \App\Models\ProjectBugSeverity::create($type);
        }
    }
}
