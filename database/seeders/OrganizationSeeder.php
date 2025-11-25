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
                'type' => 'non-government',
                'address_1' => 'Wisma PPZ 68-1-6 Dataran Shamelin, Jalan 4/91',
                'address_2' => 'Taman Shamelin Perkasa, 56100 Kuala Lumpur',
                'country_id' => 1,
                'state_id' => 14,
                'city_id' => 179,
                'postcode' => '56100',
                'priority' => 'high',
                'status' => 'verified',
            ],
            [
                'name' => 'MAIWP',
                'display_name' => 'Majlis Agama Islam Wilayah Persekutuan',
                'type' => 'government',
                'address_1' => 'Menara MAIWP, 39, Lrg Haji Hussein 2, Chow Kit',
                'address_2' => '50300 Kuala Lumpur, Federal Territory of Kuala Lumpur',
                'country_id' => 1,
                'state_id' => 14,
                'city_id' => 179,
                'postcode' => '50300',
                'priority' => 'low',
                'status' => 'verified',
            ],
            [
                'name' => 'JAKIM',
                'display_name' => 'Jabatan Kemajuan Islam Malaysia',
                'type' => 'government',
                'address_1' => 'Blok A dan B, Kompleks Islam Putrajaya, No 23',
                'address_2' => 'Jalan Tunku Abdul Rahman, Presint 3, 62100 Putrajaya',
                'country_id' => 1,
                'state_id' => 16,
                'city_id' => 179,
                'postcode' => '62100',
                'priority' => 'low',
                'status' => 'verified',
            ],
            [
                'name' => 'PAHANG GO',
                'display_name' => 'Pahang Go Sdn Bhd',
                'type' => 'government',
                'address_1' => 'Avenue, No. B8-2, Jalan KS 1, 13, Jalan Kota SAS',
                'address_2' => 'Kota Sultan Ahmad Shah, 25200 Kuantan, Pahang',
                'country_id' => 1,
                'state_id' => 6,
                'city_id' => 179,
                'postcode' => '25200',
                'priority' => 'low',
                'status' => 'verified',
            ],
            [
                'name' => 'LZS Selangor',
                'display_name' => 'Lembaga Zakat Selangor',
                'type' => 'government',
                'address_1' => 'Ibu Pejabat Zakat Selangor, 1, Persiaran Bandar Raya',
                'address_2' => 'Seksyen 14, 40000 Shah Alam, Selangor',
                'country_id' => 1,
                'state_id' => 10,
                'city_id' => 179,
                'postcode' => '40000',
                'priority' => 'low',
                'status' => 'verified',
            ]
        ];

        foreach ($orgs as $org) {
            \App\Models\Organization::create($org);
        }
    }
}
