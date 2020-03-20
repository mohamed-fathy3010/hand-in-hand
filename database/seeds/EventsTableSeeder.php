<?php

use App\Event;
use Illuminate\Database\Seeder;
class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Event::class,100)->create([
            'image'=>'default.png'
        ]);
    }
}
