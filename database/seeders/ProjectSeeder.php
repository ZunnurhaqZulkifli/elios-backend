<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Portal Bantuan Zakat MAIWP',
            ],
            [
                'title' => 'Sistem Agihan Transit & CSR',
            ],
            [
                'title' => 'My Wakalah Frontend',
            ],
            [
                'title' => 'My Wakalah Backend',
            ],
            [
                'title' => 'My Wakalah Mobile',
            ],
            [
                'title' => 'My Zakat Mobile',
            ],
            [
                'title' => 'Ejinayat Backend',
            ],
            [
                'title' => 'E-Pay ADM',
            ],
        ];
        
        foreach ($projects as $project) {
            \App\Models\Project::create($project);
        }
    }
}
