<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'title'=>"E-mart online shopping",
            'meta_description'=>"E-mart online shopping",
            'meta_keywords'=>"E-mart, online shopping, E-comerce website",
            'logo'=>"frontend/img/core-img/logo.png",
            'favicon'=>" ",
            'address'=>"Egypt, Menfoia",
            'email'=>"oppnot@gmail.com",
            'phone'=>"01026833710",
            'fax'=>'0201026833710',
            'footer'=>'Mohamed Ali',
            'facebook_url'=>'',
            'twitter_url'=>'',
            'linkedin_url'=>'',
            'pinterest_url'=>'',

        ]);
        DB::table('brands')->insert([
            [
                'title'=>'Rolex',
                'slug'=>'rolex',
                'photo'=>'frontend/img/partner-img/5.jpg',
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                ],
                [
                    'title'=>'aetna',
                    'slug'=>'aetna',
                    'photo'=>'frontend/img/partner-img/6.jpg',
                    'status'=>'active',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
                [
                    'title'=>'Zara',
                    'slug'=>'Zara',
                    'photo'=>'frontend/img/partner-img/2.jpg',
                    'status'=>'active',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
                [
                    'title'=>'Adidas',
                    'slug'=>'adidas',
                    'photo'=>'frontend/img/partner-img/3.jpg',
                    'status'=>'active',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
                [
                    'title'=>'Nike',
                    'slug'=>'nike',
                    'photo'=>'frontend/img/partner-img/4.jpg',
                    'status'=>'active',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
                [
                    'title'=>'H&M',
                    'slug'=>'h-m',
                    'photo'=>'frontend/img/partner-img/1.jpg',
                    'status'=>'active',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
             
            ]);

            DB::table('categories')->insert([
            
                [
                'title'=>'craft collection',
                'slug'=>'craft-collection',
                'photo'=>'frontend/img/gallery/1.png',
                'is_parent'=>1,
                'parent_id'=>null,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                ],
                [
                    'title'=>'women collection',
                    'slug'=>'women-collection',
                    'photo'=>'frontend/img/gallery/2.png',
                    'is_parent'=>1,
                    'parent_id'=>null,
                    'status'=>'active',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
                [
                    'title'=>'kids collection',
                    'slug'=>'kids-collection',
                    'photo'=>'frontend/img/gallery/3.png',
                    'is_parent'=>1,
                    'parent_id'=>null,
                    'status'=>'active',
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ],
             
        
            ]);


            DB::table('banners')->insert([
                [
                'title'=>'Social offer',
                'slug'=>'Social offer',
                'description'=>'only $70',
                'photo'=>'frontend/img/bg-img/8.jpg',
                'status'=>'active',
                'condition'=>'banner',
                ],
                [
                'title'=>'soustaioable clock',
                'slug'=>'soustaioable clock',
                'description'=>'only $81',
                'photo'=>'frontend/img/bg-img/7.jpg',
                'status'=>'active',
                'condition'=>'banner',
                ],
                [
                'title'=>'hot shose',
                'slug'=>'hot shose',
                'description'=>'only $19',
                'photo'=>'frontend/img/bg-img/6.jpg',
                'status'=>'active',
                'condition'=>'banner',
                ],
                [
                'title'=>'ALL KIDS ITEMS',
                'slug'=>'ALL KIDS ITEMS',
                'description'=>'30% off',
                'photo'=>'frontend/img/bg-img/fea_offer.jpg',
                'status'=>'active',
                'condition'=>'banner',
                ],
        
            ]);
    }
}
