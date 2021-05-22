<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'phuongthang',
            'email' => 'thang.pc@beetechsoft.vn',
            'password' => Hash::make('123456'),
            'fullname'=> 'Phuong Cong Thang',
            'phone' => '0344771283',
            'address' => '235 Hoang Quoc Viet',
            'description' => "Hi I'm Thang",

        ]);
        DB::table('admins')->insert([
            'username' => 'nguyenthichinh',
            'email' => 'chinh.nt@beetechsoft.vn',
            'password' => Hash::make('123456'),
            'fullname'=> 'Nguyen Thi Chinh',
            'phone' => '0344771283',
            'address' => '235 Hoang Quoc Viet',
            'description' => "Hi I'm Chinh",

        ]);
    }
}
