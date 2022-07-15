<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('organisers')->delete();
        \DB::table('events')->delete();
        factory(App\Models\Event::class, 5)->create();
    }
}
