<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(TestPermissionSeeder::class);
        // $this->call(CreateAdminUserSeeder::class);
        // $this->call(DiseasesSeeder::class);
        $this->call(NrcPrefixSeeder::class);
        // $this->call(DaySeeder::class);
    }
}
