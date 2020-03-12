<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Item::class,100)->create([
            'image'=>'1582808660.jpg'
        ]);
    }
}
