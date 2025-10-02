<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orgs = [
            [
                'name' => 'PPZ',
                'display_name' => 'Pusat Pungutan Zakat',
                'type' => 'organization',
                'address_1' => 'Taman Shamelin Perkasa',
            ],
            [
                'name' => 'MAIWP',
                'display_name' => 'Majlis Agama Islam Wilayah Persekutuan',
                'type' => 'organization',
                'address_1' => 'Kampung Baru (HQ)',
            ],
            [
                'name' => 'JAKIM',
                'display_name' => 'Jabatan Kemajuan Islam Malaysia',
                'type' => 'organization',
                'address_1' => 'Putrajaya (HQ)',
            ],
        ];

        foreach ($orgs as $org) {
            \App\Models\Organization::create($org);
        }
    }
}
