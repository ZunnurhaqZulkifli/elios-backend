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
                'name'              => 'System Administrator',
                'email'             => 'admin@zakat.com.my',
                'username'          => 'system admin',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Muhammad Zunnurhaq Bin Zulkifli',
                'email'             => 'zunnur@my-sands.com',
                'username'          => Str::lower('Muhammad Zunnurhaq Bin Zulkifli'),
                'password'          => Hash::make('a'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Shahjuhan Samsuri',
                'email'             => 'juhan@my-sands.com',
                'username'          => Str::lower('Shahjuhan Samsuri'),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Amin Adha Bin Mas ud',
                'email'             => 'amin@my-sands.com',
                'username'          => Str::lower('Amin Adha Bin Mas ud'),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Nuh Salleh ( PPZ )',
                'email'             => 'nuh@ppz.my',
                'username'          => Str::lower('Nuh Salleh'),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Farhan ( PPZ )',
                'email'             => 'farhan@ppz.my',
                'username'          => Str::lower('Farhan'),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Syahriel Zulkefli ( PPZ )',
                'email'             => 'shahril@ppz.my',
                'username'          => Str::lower('Syahriel Zulkefli'),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Zulkifli Basir ( PPZ )',
                'email'             => 'zulkifli@ppz.my',
                'username'          => Str::lower('Zulkifli Basir'),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Nur Syamimi ( PPZ )',
                'email'             => 'mimo@ppz.my',
                'username'          => Str::lower('Nur Syamimi'),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Nurul Iman ( PPZ )',
                'email'             => 'iman@ppz.my',
                'username'          => Str::lower('Nurul Iman'),
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Imran ( PPZ )',
                'email'             => 'imran@ppz.my',
                'username'          => Str::lower('Imran'),
                'password'          => Hash::make('password'),
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
