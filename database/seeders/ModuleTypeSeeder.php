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
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel API CRUD',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Model',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Controller',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel View',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Database',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Migration',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Seeder',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Service',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Notification',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Job',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Event',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Listener',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Middleware',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Command',
                'framework_id' => 1,
            ],
            [
                'name' => 'Laravel Test',
                'framework_id' => 1,
            ],

            // Flutter Module Types
            [
                'name' => 'Flutter All',
                'framework_id' => 2,
            ],
            [
                'name' => 'Flutter Model',
                'framework_id' => 2,
            ],
            [
                'name' => 'Flutter Service',
                'framework_id' => 2,
            ],
            [
                'name' => 'Flutter Page',
                'framework_id' => 2,
            ],
            [
                'name' => 'Flutter State Management',
                'framework_id' => 2,
            ],
            [
                'name' => 'Flutter API Integration',
                'framework_id' => 2,
            ],
            [
                'name' => 'Flutter Database Integration',
                'framework_id' => 2,
            ],
            [
                'name' => 'Flutter Widget',
                'framework_id' => 2,
            ],
            [
                'name' => 'Flutter Animation',
                'framework_id' => 2,
            ],
            [
                'name' => 'Flutter Navigation',
                'framework_id' => 2,
            ],
            [
                'name' => 'Flutter Testing',
                'framework_id' => 2,
            ],

            // Laravel Full Module Template
            [
                'name' => 'Laravel',
                'framework_id' => 1,
            ],
        ];

        foreach ($types as $type) {
            \App\Models\ModuleType::updateOrInsert($type);
        }
    }
}
