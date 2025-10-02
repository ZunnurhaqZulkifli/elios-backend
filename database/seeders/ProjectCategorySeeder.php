<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Frontend', 
                'weight' => 3.00, 
            ],
            [
                'name' => 'Backend', 
                'weight' => 2.00, 
            ],
            [
                'name' => 'Mobile', 
                'weight' => 2.00, 
            ],
            [
                'name' => 'Design', 
                'weight' => 2.00, 
            ],
        ];

        foreach ($types as $type) {
            \App\Models\ProjectCategory::create($type);
        }
    }
}
