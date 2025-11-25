<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'title'              => '',
                'project_id'         => '',
                'type_id'            => '',
                'estimated_duration' => '',
                'total_duration'     => '',
                'progress'           => '',
                'status'             => '',
            ],
        ];
    }
}
