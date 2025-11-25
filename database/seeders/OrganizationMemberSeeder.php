<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'organization_id' => 1,
                'individual_id' => 5,
            ],
            [
                'organization_id' => 1,
                'individual_id' => 6,
            ],
            [
                'organization_id' => 1,
                'individual_id' => 7,
            ],
            [
                'organization_id' => 1,
                'individual_id' => 8,
            ],
            [
                'organization_id' => 1,
                'individual_id' => 9,
            ],
            [
                'organization_id' => 1,
                'individual_id' => 10,
            ],
            [
                'organization_id' => 1,
                'individual_id' => 11,
            ],
            [
                'organization_id' => 1,
                'individual_id' => 12,
            ],
            [
                'organization_id' => 1,
                'individual_id' => 13,
            ],
        ];

        foreach ($members as $member) {
            \App\Models\OrganizationMember::create($member);
        }
    }
}
