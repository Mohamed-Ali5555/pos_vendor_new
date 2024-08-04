<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminSeeder::class);
        $this->call(CurrenciesSeeder::class);
        $this->call(UserTableSeeder::class);

        $this->call(AboutUsSeeder::class);
        $this->call(SettingSeeder::class);

         \App\Models\Category::factory(20)->create();
        \App\Models\Brand::factory(10)->create();//this is meen create 10 product of brand or any number you need
        \App\Models\Product::factory(50)->create();
    }
}
