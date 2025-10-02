<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndividualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inds = [
            [
                'name' => 'Zunnurhaq',
                'display_name' => 'Muhammad Zunnurhaq Bin Zulkilfi',
                'title' => 'Developer',
                'position' => 'Developer',
            ],
            [
                'name' => 'Zulfa',
                'display_name' => 'Zulfajuniadi Bin Zulkifli',
                'title' => 'Developer',
                'position' => 'Developer',
            ],
            [
                'name' => 'Amin',
                'display_name' => 'Amin Adha Bin Mas ud',
                'title' => 'Developer',
                'position' => 'Developer',
            ],
            [
                'name' => 'Shahjuhan',
                'display_name' => 'Shahjuhan Samsuri',
                'title' => 'Manager',
                'position' => 'Manager',
            ],
            [
                'name' => 'Shahjuhan',
                'display_name' => 'Shahjuhan Samsuri',
                'title' => 'Manager',
                'position' => 'Manager',
            ],
        ];

        foreach ($inds as $ind) {
            \App\Models\Individual::create($ind);
        }
    }
}
