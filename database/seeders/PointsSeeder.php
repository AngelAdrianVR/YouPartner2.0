<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points')->insert(array(
            [
                'concept' => 'COLLABORATION_COMPLETED',
                'value' => 0.5,
                'unit' => '%',
            ],
            [
                'concept' => 'COLLABORATION_ACCEPTED',
                'value' => 0.5,
                'unit' => '%',
            ],
            [
                'concept' => 'HOMEWORK_UPLOADED',
                'value' => 1,
                'unit' => 'p',
            ],
            [
                'concept' => 'RATE_CREATED',
                'value' => 1,
                'unit' => 'p',
            ],
            [
                'concept' => 'COLLABORATION_CANCELED',
                'value' => -5,
                'unit' => 'p',
            ],
            [
                'concept' => 'TRICKY_CLAIM',
                'value' => -5,
                'unit' => 'p',
            ],
        ));
    }
}
