<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'phuongthang',
            'email' => 'thang.pc@beetechsoft.vn',
            'password' => Hash::make('123456'),
            'fullname'=> 'Phuong Cong Thang',
            'position' => 'Backend Developer',
            'phone' => '0344771283',
            'address' => '235 Hoang Quoc Viet',
            'description' => "Hi I'm Thang",
        ]);
        DB::table('users')->insert([
            'username' => 'chinhnt',
            'email' => 'chinh.nt@beetechsoft.vn',
            'password' => Hash::make('123456'),
            'fullname'=> 'Nguyen Thi Chinh',
            'position' => 'Front Developer',
            'phone' => '0344771283',
            'address' => '235 Hoang Quoc Viet',
            'description' => "Hi I'm Chinh",

        ]);
    }
}
