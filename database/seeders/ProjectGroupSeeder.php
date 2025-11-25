<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectGroups = [
            [
                'group_id' => 1,
                'project_id' => 1,
            ],
            [
                'group_id' => 2,
                'project_id' => 2,
            ],
            [
                'group_id' => 2,
                'project_id' => 3,
            ],
            [
                'group_id' => 2,
                'project_id' => 4,
            ],
            [
                'group_id' => 3,
                'project_id' => 7,
            ],
            [
                'group_id' => 3,
                'project_id' => 8,
            ],
            [
                'group_id' => 3,
                'project_id' => 9,
            ],
            [
                'group_id' => 4,
                'project_id' => 10,
            ],
            [
                'group_id' => 4,
                'project_id' => 11,
            ],
            [
                'group_id' => 5,
                'project_id' => 12,
            ],
            [
                'group_id' => 6,
                'project_id' => 13,
            ],
            [
                'group_id' => 7,
                'project_id' => 14,
            ],
            [
                'group_id' => 7,
                'project_id' => 15,
            ],
            [
                'group_id' => 7,
                'project_id' => 16,
            ]
        ];

        foreach ($projectGroups as $projectGroup) {
            \App\Models\ProjectGroup::create($projectGroup);
        }
    }
}
