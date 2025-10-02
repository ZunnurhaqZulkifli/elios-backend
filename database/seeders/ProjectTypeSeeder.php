<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Work Sands', 
                'weight' => 5.00, 
            ],
            [
                'name' => 'Personal Project', 
                'weight' => 2.00, 
            ],
        ];

        foreach ($types as $type) {
            \App\Models\ProjectType::create($type);
        }
    }
}
