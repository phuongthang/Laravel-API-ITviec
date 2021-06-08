<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'username' => 'beetechsoft',
            'email' => 'beetech@beetechsoft.vn',
            'password' => Hash::make('123456'),
            'fullname'=> 'Beetech Soft',
            'field' => 'Software',
            'establishment'=> '2000-01-01',
            'phone' => '0344771283',
            'address' => '235 Hoang Quoc Viet',
            'description' => "Hi I'm Beetech Soft",

        ]);
        DB::table('organizations')->insert([
            'username' => 'garena',
            'email' => 'garena@beetechsoft.vn',
            'password' => Hash::make('123456'),
            'fullname'=> 'Garena',
            'field' => 'Software',
            'establishment'=> '2000-01-01',
            'phone' => '0344771283',
            'address' => '235 Hoang Quoc Viet',
            'description' => "Hi I'm BeetInnovator",

        ]);
    }
}
