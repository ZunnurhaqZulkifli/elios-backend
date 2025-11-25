<?php

namespace Database\Seeders;

use App\Enums\JobPosition;
use App\Enums\JobTitle;
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
                'name' => 'Zunnurhaq Zulkifli',
                'display_name' => 'Muhammad Zunnurhaq Bin Zulkilfi',
                'title' => JobTitle::DEVELOPER,
                'position' => JobPosition::SENIOR,
                'email' => 'zunnur@my-sands.com',
                'about' => 'Sands Consultant Developer',
                'phone' => '0134065517',
                'address_1' => 'Lot 1675D, Jalan Nazir',
                'address_2' => 'Kampung Sungai Ramal Dalam, Kajang',
                'country_id' => 1,
                'state_id' => 10,
                'city_id' => 121,
                'postcode' => '43000',
                'priority' => 'ultimate',
                'status' => 'verified',
            ],
            [
                'name' => 'Zulfa Zulkifli',
                'display_name' => 'Zulfajuniadi Bin Zulkifli',
                'title' => JobTitle::CTO,
                'position' => JobPosition::SENIOR,
                'email' => 'zulfa@my-sands.com',
                'about' => 'Sands Consultant Developer',
                'phone' => '0192727155',
                'address_1' => 'Lot 1675D, Jalan Nazir',
                'address_2' => 'Kampung Sungai Ramal Dalam, Kajang',
                'country_id' => 1,
                'state_id' => 10,
                'city_id' => 121,
                'postcode' => '43000',
                'priority' => 'ultimate',
                'status' => 'verified',
            ],
            [
                'name' => 'Amin Adha',
                'display_name' => 'Amin Adha Bin Mas ud',
                'title' => JobTitle::DEVELOPER,
                'position' => JobPosition::SENIOR,
                'email' => 'amin@my-sands.com'
            ],
            [
                'name' => 'Shahjuhan Samsuri',
                'display_name' => 'Shahjuhan Samsuri',
                'title' => JobTitle::MANAGER,
                'position' => JobPosition::DIRECTOR,
                'email' => 'juhan@my-sands.com',
            ],
            [
                'name' => 'Nuh Salleh',
                'display_name' => 'Muhammad Nuh Idris Ahmad',
                'title' => JobTitle::SENIOR,
                'position' => JobPosition::EXECUTIVE,
                'email' => 'idris@zakat.com.my',
            ],
            [
                'name' => 'Ahmad Farhan',
                'display_name' => 'Ahmad Farhan Shagul Hamed',
                'title' => JobTitle::SENIOR,
                'position' => JobPosition::EXECUTIVE,
                'email' => 'ahmadfarhan@zakat.com.my',
            ],
            [
                'name' => 'Syahriel Zulkefli',
                'display_name' => 'Syahriel Bin Zulkefli',
                'title' => JobTitle::DEVELOPER,
                'position' => JobPosition::SENIOR,
                'email' => 'syahril@zakat.com.my',
            ],
            [
                'name' => 'Shafiq Ruslan',
                'display_name' => 'Mohd Shafiq Ruslan',
                'title' => JobTitle::DEVELOPER,
                'position' => JobPosition::JUNIOR,
                'email' => 'shafiqruslan@zakat.com.my',
            ],
            [
                'name' => 'Muhd Nazeri',
                'display_name' => 'Muhd Nazeri Darmawi',
                'title' => JobTitle::DEVELOPER,
                'position' => JobPosition::JUNIOR,
                'email' => 'nazeri@zakat.com.my',
            ],
            [
                'name' => 'Zulkifli Basir',
                'display_name' => 'Zulkifli Basir',
                'title' => JobTitle::SENIOR,
                'position' => JobPosition::EXECUTIVE,
                'email' => 'zulbasir@zakat.com.my',
            ],
            [
                'name' => 'Nurul Iman',
                'display_name' => 'Nurul Iman',
                'title' => JobTitle::SENIOR,
                'position' => JobPosition::EXECUTIVE,
                'email' => 'iman@zakat.com.my',
            ],
            [
                'name' => 'Nur Shamimi',
                'display_name' => 'Nur Shamimi',
                'title' => JobTitle::SENIOR,
                'position' => JobPosition::EXECUTIVE,
                'email' => 'nur.shamimi@zakat.com.my',
            ],
            [
                'name' => 'Imran',
                'display_name' => 'Imran',
                'title' => JobTitle::SENIOR,
                'position' => JobPosition::EXECUTIVE,
                'email' => 'imran@zakat.com.my',
            ],
        ];

        foreach ($inds as $ind) {
            \App\Models\Individual::create($ind);
        }
    }
}
