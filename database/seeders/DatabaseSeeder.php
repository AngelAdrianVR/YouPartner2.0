<?php

namespace Database\Seeders;

use App\Models\Homework;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            SchoolSubjectSeeder::class,
            PointsSeeder::class,
            ConfigurationsSeeder::class,
        ]);

        User::factory(10)->create();
        Homework::factory(25)->create();
    }
}
