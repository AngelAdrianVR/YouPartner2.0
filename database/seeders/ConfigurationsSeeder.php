<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert(array(
            [
                'module' => 'ranking',
                'key' => 'SHOW_BY_RATE',
                'value' => 1,
                'notes' => 'show top x filtering by rate of collaborations',
            ],
            [
                'module' => 'ranking',
                'key' => 'MIN_RATES_REQUIRED',
                'value' => 10,
                'notes' => 'minimum rates user has to have for appear on top x by rates',
            ],
            [
                'module' => 'ranking',
                'key' => 'SHOW_BY_LVL_POINTS',
                'value' => 1,
                'notes' => 'show top x filtering by level points',
            ],
            [
                'module' => 'ranking',
                'key' => 'SHOW_BY_HOMEWORKS',
                'value' => 1,
                'notes' => 'show top x filtering by uploaded homeworks',
            ],
            [
                'module' => 'ranking',
                'key' => 'SHOW_BY_COLLABORATIONS',
                'value' => 1,
                'notes' => 'show top x filtering by completed collaborations',
            ],
        ));
    }
}
