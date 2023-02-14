<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;
class AdminSeeder extends Seeder
{
    /**
     * button bill -> show bill that have print button 
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        DB::table('admins')->insert([
                
             
            [
               'name'=>'mohamed admin',
               'email'=>'admin@gmail.com',
               'password'=>Hash::make('01230123'),                
            //    'status'=>'active', 
            ],
           ]);
    }
}
