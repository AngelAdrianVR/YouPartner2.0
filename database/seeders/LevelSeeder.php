<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert(array(
            [
                'max_points' => '50',
                'tax' => 12,
            ],
            [
                'max_points' => '100',
                'tax' => 11,
            ],
            [
                'max_points' => '180',
                'tax' => 10,
            ],
            [
                'max_points' => '280',
                'tax' => 9,
            ],
            [
                'max_points' => '1500',
                'tax' => 8,
            ],
            [
                'max_points' => '5000',
                'tax' => 0,
            ],
        ));
    }
}
