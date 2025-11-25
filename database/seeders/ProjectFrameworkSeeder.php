<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectFrameworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $frameworks = [
            [
                'name' => 'Laravel',
                'status' => 'active',
            ],
            [
                'name' => 'Flutter',
                'status' => 'active',
            ],
            [
                'name' => 'React',
                'status' => 'active',
            ],
            [
                'name' => 'Next.js',
                'status' => 'active',
            ],
        ];

        foreach ($frameworks as $framework) {
            DB::table('project_frameworks')->insert($framework);
        }
    }
}
