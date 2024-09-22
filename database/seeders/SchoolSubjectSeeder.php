<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_subjects')->insert(array(
            [
                'name' => 'Matemáticas',
            ],
            [
                'name' => 'Física',
            ],
            [
                'name' => 'Química',
            ],
            [
                'name' => 'Programación',
            ],
            [
                'name' => 'Inglés',
            ],
            [
                'name' => 'Español',
            ],
            [
                'name' => 'Artes',
            ],
            [
                'name' => 'Contabilidad',
            ],
            [
                'name' => 'Electrónica',
            ],
            [
                'name' => 'Ciencias sociales',
            ],
            [
                'name' => 'Mecánica',
            ],
        ));
    }
}
