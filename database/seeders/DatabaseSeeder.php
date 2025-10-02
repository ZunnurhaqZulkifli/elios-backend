<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $options = [
            'selector_1' => [
                'title' => 'Migrate & Seed Only',
            ],

            'selector_2' => [
                'title' => 'Dump Database & Migrate & Seed',
            ],
        ];

        $choice = $this->command->choice(
            'Select Seeding Options',
            [
                'Exit Seeder',
                $options['selector_1']['title'],
                $options['selector_2']['title'],
            ],
            0
        );

        if ($choice == 'Migrate & Seed Only') {
            $this->option1();
        } else if ($choice == 'Dump Database & Migrate & Seed') {
            $this->option2();
        }
    }


    public function option1()
    {
        $confirm = $this->command->confirm('Run Migrate & Seed ?', 0);
        if ($confirm == '1') {
            $this->command->call('migrate');
            $this->seeder();
            $this->command->info('Selected 1 : Database Successfully Migrated & Seeded');
        } else {
            exit(0);
        }
    }

    public function option2()
    {
        $confirm = $this->command->confirm('!! Warning !! Run Dump Database & Run Migration & Seed ?', 0);
        if ($confirm == '1') {
            $this->command->call('db:wipe');
            $this->command->call('migrate');
            $this->seeder();
            $this->command->info('Selected 3 : Database Was Successfully Dumped & Migrated & Seeded');
        } else {
            exit(0);
        }
    }

    public function seeder()
    {
        $this->call([

            // Dependant Reference Tables
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,

            // Project Related
            ProjectTypeSeeder::class,
            ProjectCategorySeeder::class,

            // Module Related
            ModuleTypeSeeder::class,

            // Task Related
            TaskTypeSeeder::class,
            TaskLevelSeeder::class,

            // Main Tables
            UserSeeder::class,
            IndividualSeeder::class,
            OrganizationSeeder::class,
            ProjectSeeder::class,
                      
        ]);
        // DO NOT REMOVE THIS LINES
        $this->command->call('inspire');
    }
}
