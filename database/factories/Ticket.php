<?php

use Illuminate\Support\Carbon;

$factory->define(App\Models\Ticket::class, function (Faker\Generator $faker) {
    return [
        'event_id' => function () {
            return factory(App\Models\Event::class)->create()->id;
        },
        'title' => $faker->name,
        'description' => $faker->text,
        'price' => 50.00,
        'max_per_person' => 4,
        'min_per_person' => 1,
        'quantity_available' => 50,
        'quantity_sold' => 0,
        'start_sale_date' => Carbon::now()->format('Y-m-d H:i:s'),
        'end_sale_date' => Carbon::now()->addDays(20)->format('Y-m-d H:i:s'),
        'is_paused' => 0,
    ];
});
