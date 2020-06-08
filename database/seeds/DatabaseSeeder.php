<?php

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
        DB::table('items')->truncate();
        DB::table('events')->truncate();
        DB::table('products')->truncate();
        DB::table('services')->truncate();
         $this->call(ItemsTableSeeder::class);
         $this->call(EventsTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(ServicesTableSeeder::class);
    }
}
