<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('experiences')->insert([
            'experience' => 'Fresher',
        ]);
        DB::table('experiences')->insert([
            'experience' => 'Junior',
        ]);
        DB::table('experiences')->insert([
            'experience' => 'Senior',
        ]);
        DB::table('experiences')->insert([
            'experience' => 'DevOps',
        ]);
        DB::table('experiences')->insert([
            'experience' => 'Frontend',
        ]);
        DB::table('experiences')->insert([
            'experience' => 'Backend',
        ]);
        DB::table('experiences')->insert([
            'experience' => 'Fullstack',
        ]);
    }
}
