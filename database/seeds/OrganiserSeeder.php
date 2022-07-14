<?php

use Illuminate\Database\Seeder;

class OrganiserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('organisers')->delete();
        factory(App\Models\Organiser::class, 10)->create();
    }
}
