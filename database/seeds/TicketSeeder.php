<?php

use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tickets')->delete();
        \DB::table('events')->delete();
        \DB::table('organisers')->delete();
        factory(App\Models\Ticket::class, 10)->create();
    }
}
