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
         $this->call(ItemsTableSeeder::class);
         $this->call(EventsTableSeeder::class);
    }
}
