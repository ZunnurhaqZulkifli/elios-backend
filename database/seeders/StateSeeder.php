<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            [
                'country_id' => 1,
                'name'      => 'Johor',
                'display_name' => 'Johor Darul Takzim',
                'code'      => 'JHR',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Kedah',
                'display_name' => 'Kedah Darul Aman',
                'code'      => 'KDH',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Kelantan',
                'display_name' => 'Kelantan Darul Naim',
                'code'      => 'KTN',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Melaka',
                'display_name' => 'Melaka Bandaraya Bersejarah',
                'code'      => 'MLK',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Negeri Sembilan',
                'display_name' => 'Negeri Sembilan Darul Khusus',
                'code'      => 'NSN',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Pahang',
                'display_name' => 'Pahang Darul Makmur',
                'code'      => 'PHG',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Pulau Pinang',
                'display_name' => 'Pulau Pinang Pulau Mutiara',
                'code'      => 'PNG',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Perak',
                'display_name' => 'Perak Darul Ridzuan',
                'code'      => 'PRK',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Perlis',
                'display_name' => 'Perlis Indera Kayangan',
                'code'      => 'PLS',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Selangor',
                'display_name' => 'Selangor Darul Ehsan',
                'code'      => 'SGR',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Terennganu',
                'display_name' => 'Terennganu Darul Iman',
                'code'      => 'TRG',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Sabah',
                'display_name' => 'Sabah Negeri Di Bawah Bayu',
                'code'      => 'SBH',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Sarawak',
                'display_name' => 'Sarawak Bumi Kenyalang',
                'code'      => 'SRW',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Kuala Lumpur',
                'display_name' => 'Wilayah Persekutuan Kuala Lumpur',
                'code'      => 'WKL',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Labuan',
                'display_name' => 'Wilayah Persekutuan Labuan',
                'code'      => 'WPL',
                'status'    => 'active',
            ],
            [
                'country_id' => 1,
                'name'      => 'Putrajaya',
                'display_name' => 'Wilaayah Persekutuan Putrajaya',
                'code'      => 'PJY',
                'status'    => 'active',
            ],
            [
                'country_id' => 221,
                'name'      => 'Luaar Negara',
                'display_name' => 'Luar Negara',
                'code'      => 'LNE',
                'status'    => 'active',
            ],
            [
                'country_id' => 221,
                'name'      => 'Tiada',
                'display_name' => 'TIADA',
                'code'      => '-',
                'status'    => 'active',
            ],
        ];

        foreach ($states as $state) {
            State::updateOrCreate([
                'country_id' => $state['country_id'],
                'name'       => $state['name'],
                'display_name'  => $state['display_name'],
                'code'       => $state['code'],
                'status'     => $state['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ], []);
        }
    }
}
