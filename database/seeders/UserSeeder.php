<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }
    public function run(): void
    {
        $users = 
        [
            [
                'name'              => 'Muhammad Zunnurhaq Bin Zulkifli',
                'email'             => 'zunnur@my-sands.com',
                'username'          => Str::lower('Muhammad Zunnurhaq Bin Zulkifli'),
                'password'          => Hash::make('a'),
                'role'              => 'admin',
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]; 

        foreach ($users as $key => $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user,
            );
        }
    }
}
