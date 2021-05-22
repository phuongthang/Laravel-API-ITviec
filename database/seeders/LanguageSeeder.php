<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'language' => 'C',
        ]);
        DB::table('languages')->insert([
            'language' => 'C++',
        ]);
        DB::table('languages')->insert([
            'language' => 'C#',
        ]);
        DB::table('languages')->insert([
            'language' => 'Javascript',
        ]);
        DB::table('languages')->insert([
            'language' => 'Python',
        ]);
        DB::table('languages')->insert([
            'language' => 'PHP',
        ]);
        DB::table('languages')->insert([
            'language' => 'Ruby',
        ]);
        DB::table('languages')->insert([
            'language' => 'Java',
        ]);
        DB::table('languages')->insert([
            'language' => 'NodeJs',
        ]);
        DB::table('languages')->insert([
            'language' => 'Android',
        ]);
        DB::table('languages')->insert([
            'language' => 'iOS',
        ]);
        DB::table('languages')->insert([
            'language' => 'Swift',
        ]);
        DB::table('languages')->insert([
            'language' => 'Go',
        ]);
        DB::table('languages')->insert([
            'language' => 'Objective-C ',
        ]);
        DB::table('languages')->insert([
            'language' => 'R',
        ]);
        DB::table('languages')->insert([
            'language' => 'SQL',
        ]);
        DB::table('languages')->insert([
            'language' => 'Laravel',
        ]);
    }
}
