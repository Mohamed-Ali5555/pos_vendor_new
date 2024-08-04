<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'=>"Mohamed Ali",
            'email'=>"admin@admin.com",
            'password'=>Hash::make('01230123'),

        ]);

        DB::table('sellers')->insert([
            'full_name'=>"Mohamed Ali",
            'username'=>"Mohamed Ali",
            'email'=>"mohamed@gmail.com",
            'status'=>"active",
            'is_verified'=>"0",

            'password'=>Hash::make('01230123'),

        ]);
    }
}
