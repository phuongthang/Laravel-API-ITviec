<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'type' => 'Full time',
        ]);
        DB::table('types')->insert([
            'type' => 'Part time',
        ]);
        DB::table('types')->insert([
            'type' => 'Freelancer',
        ]);
        DB::table('types')->insert([
            'type' => 'Remote',
        ]);
    }
}
