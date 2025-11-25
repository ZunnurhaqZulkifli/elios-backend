<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleTaskTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            // Basic Laravel CRUD Templates
            [
                'module_type_id' => 1,
                'title'          => 'Create Model',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Create Model Controller',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Create Model Actions',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Create Model Views',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Resource',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Fillables',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Casts',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Relations',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Store-Request',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Update-Request',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Migration',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Seeder',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Register Model Policy',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Register Model Web-Routes',
            ],

            // Laravel API CRUD Templates
            [
                'module_type_id' => 1,
                'title'          => 'Create Model Api Controller',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Create Model Api Actions',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Resource',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Store-Request',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Update Model Update-Request',
            ],
            [
                'module_type_id' => 1,
                'title'          => 'Register Model Api-Routes',
            ],
            
            // Laravel Model Template
            [
                'module_type_id' => 3,
                'title'          => 'Create Model',
            ],
            [
                'module_type_id' => 3,
                'title'          => 'Update Model Fillables',
            ],
            [
                'module_type_id' => 3,
                'title'          => 'Update Model Casts',
            ],
            [
                'module_type_id' => 3,
                'title'          => 'Update Model Relations',
            ],
            
            // Laravel Controller Template
            [
                'module_type_id' => 4,
                'title'          => 'Create Controller',
            ],
            [
                'module_type_id' => 4,
                'title'          => 'Create Controller Actions',
            ],
            [
                'module_type_id' => 4,
                'title'          => 'Register Controller Route',
            ],

            // Laravel View Template
            [
                'module_type_id' => 5,
                'title'          => 'Create View',
            ],
            [
                'module_type_id' => 5,
                'title'          => 'Register View Route',
            ],

            // Laravel Database Template
            [
                'module_type_id' => 6,
                'title'          => 'Create Database',
            ],
            [
                'module_type_id' => 6,
                'title'          => 'Update Database Tables',
            ],

            // Laravel Migration Template
            [
                'module_type_id' => 7,
                'title'          => 'Create Migration',
            ],
            [
                'module_type_id' => 7,
                'title'          => 'Update Migration Tables',
            ],

            // Laravel Seeder Template
            [
                'module_type_id' => 8,
                'title'          => 'Create Seeder',
            ],
            [
                'module_type_id' => 8,
                'title'          => 'Update Seeder',
            ],
            [
                'module_type_id' => 8,
                'title'          => 'Register Seeder',
            ],

            // Laravel Service Template
            [
                'module_type_id' => 9,
                'title'          => 'Create Service',
            ],
            [
                'module_type_id' => 9,
                'title'          => 'Update Service',
            ],

            // Laravel Notification Template
            [
                'module_type_id' => 10,
                'title'          => 'Create Notification',
            ],
            [
                'module_type_id' => 10,
                'title'          => 'Update Notification',
            ],
            [
                'module_type_id' => 10,
                'title'          => 'Register Notification',
            ],

            // Laravel Job Template
            [
                'module_type_id' => 11,
                'title'          => 'Create Job',
            ],
            [
                'module_type_id' => 11,
                'title'          => 'Update Job',
            ],

            // Laravel Event Template
            [
                'module_type_id' => 12,
                'title'          => 'Create Event',
            ],
            [
                'module_type_id' => 12,
                'title'          => 'Update Event',
            ],

            // Laravel Listener Template
            [
                'module_type_id' => 13,
                'title'          => 'Create Listener',
            ],
            [
                'module_type_id' => 13,
                'title'          => 'Update Listener',
            ],

            // Laravel Middleware Template
            [
                'module_type_id' => 14,
                'title'          => 'Create Middleware',
            ],
            [
                'module_type_id' => 14,
                'title'          => 'Update Middleware',
            ],

            // Laravel Command Template
            [
                'module_type_id' => 15,
                'title'          => 'Create Command',
            ],
            [
                'module_type_id' => 15,
                'title'          => 'Update Command',
            ],

            // Laravel Test Template
            [
                'module_type_id' => 16,
                'title'          => 'Create Test',
            ],
            [
                'module_type_id' => 16,
                'title'          => 'Update Test',
            ],
            [
                'module_type_id' => 16,
                'title'          => 'Run Test',
            ],

            // Flutter Module Templates
            [
                'module_type_id' => 17,
                'title'          => 'Create Flutter Navigation',
            ],
            [
                'module_type_id' => 17,
                'title'          => 'Create Flutter Model',
            ],
            [
                'module_type_id' => 17,
                'title'          => 'Create Flutter Service',
            ],
            [
                'module_type_id' => 17,
                'title'          => 'Create Flutter Page',
            ],
            [
                'module_type_id' => 17,
                'title'          => 'Create Flutter Controller',
            ],
            [
                'module_type_id' => 17,
                'title'          => 'Create Flutter API Integration',
            ],
            [
                'module_type_id' => 17,
                'title'          => 'Create Flutter Test',
            ],
            [
                'module_type_id' => 18,
                'title'          => 'Create Flutter Model',
            ],
            [
                'module_type_id' => 19,
                'title'          => 'Create Flutter Service',
            ],
            [
                'module_type_id' => 20,
                'title'          => 'Create Flutter Page',
            ],
            [
                'module_type_id' => 21,
                'title'          => 'Create Flutter Controller',
            ],
            [
                'module_type_id' => 22,
                'title'          => 'Create Flutter API Integration',
            ],
            [
                'module_type_id' => 23,
                'title'          => 'Create Flutter Database Integration',
            ],
            [
                'module_type_id' => 24,
                'title'          => 'Create Flutter Widget',
            ],
            [
                'module_type_id' => 25,
                'title'          => 'Create Flutter Animation',
            ],
            [
                'module_type_id' => 26,
                'title'          => 'Create Flutter Navigation',
            ],
            [
                'module_type_id' => 27,
                'title'          => 'Create Flutter Test',
            ],

            // Laravel Full Module Template
            [
                'module_type_id' => 28,
                'title'          => '//',
            ],
        ];

        foreach ($templates as $template) {
            \App\Models\ModuleTaskTemplate::updateOrInsert($template);
        }
    }
}
