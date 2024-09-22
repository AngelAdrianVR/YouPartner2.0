<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            [
                'name' => 'Miguel Vázquez',
                'email' => 'miguelvz26.mv@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123123123'),
                'remember_token' => Str::random(10),
                'academic_grade' => 'Ingeniería- Mecatrónica',
                'school_name' => 'CETI colomos',
                'state' => 'Jalisco',
                'birthdate' => '1996-03-13',
                'description' => 'Apasionado de las ciencias exactas y programación',
                'is_admin' => 0,
                'created_at' => now(),
            ],
            [
                'name' => 'Ángel Vázquez',
                'email' => 'angelvazquez470@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'),
                'remember_token' => Str::random(10),
                'academic_grade' => 'Ingeniería- Diseño electrónico',
                'school_name' => 'CETI colomos',
                'state' => 'Jalisco',
                'birthdate' => '1996-03-13',
                'description' => 'Me gusta la programación y las matemáticas',
                'is_admin' => 0,
                'created_at' => now(),
            ],
            [
                'name' => 'Soporte YP',
                'email' => 'soporte@youpartner.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin.2022*/YP'),
                'remember_token' => Str::random(10),
                'academic_grade' => 'Soporte',
                'school_name' => 'You Partner',
                'state' => 'Jalisco',
                'birthdate' => '2022-09-13',
                'description' => null,
                'is_admin' => 1,
                'created_at' => now(),
            ],
        ));
    }
}
