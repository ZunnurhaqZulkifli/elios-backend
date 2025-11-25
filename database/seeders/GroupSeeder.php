<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => 'MySAW CSR ( Agihan Transit & CSR )',
                'description' => 'Group for MySAW CSR projects.',
            ],
            [
                'name' => 'MyWakalah ( Sistem Wakalah )',
                'description' => 'Group for MyWakalah projects.',
            ],
            [
                'name' => 'MyZakat ( Sistem Pembayaran Zakat )',
                'description' => 'Group for MyZakat projects.',
            ],
            [
                'name' => 'I-Zakat ( Portal Bantuan Zakat )',
                'description' => 'Group for I-Zakat projects.',
            ],
            [
                'name' => 'Ejinayat ( Sistem Pengurusan Jenayah Syariah )',
                'description' => 'Group for Ejinayat projects.',
            ],
            [
                'name' => 'Elios ( Sistem Pengurusan Projek Saya )',
                'description' => 'Group for Elios projects.',
            ],
            [
                'name' => 'I-Wakalah ( Portal Wakalah Agihan Zakat )',
                'description' => 'Group for I-Wakalah projects.',
            ],
        ];

        foreach ($groups as $group) {
            \App\Models\Group::create($group);
        }
    }
}
