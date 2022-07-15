<?php

use Illuminate\Support\Carbon;

$factory->define(App\Models\Event::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'location' => $faker->text,
        'description' => $faker->text,
        'start_date' => Carbon::now()->format("Y-m-d H:i:s"),
        'end_date' => Carbon::now()->addWeek()->format("Y-m-d H:i:s"),
        'on_sale_date' => Carbon::now()->subDays(20)->format("Y-m-d H:i:s"),
        'currency' => $faker->currencyCode,
        'organiser_id' => function () {
            return factory(App\Models\Organiser::class)->create()->id;
        },
        'location_address' => $faker->address,
        'location_address_line_1' => $faker->streetAddress,
        'location_address_line_2' => $faker->secondaryAddress,
        'location_country' => $faker->country,
        'location_country_code' => $faker->countryCode,
        'location_state' => $faker->state,
        'location_post_code' => $faker->postcode,
        'location_street_number' => $faker->buildingNumber,
        'location_lat' => $faker->latitude,
        'location_long' => $faker->longitude,
        'location_google_place_id' => $faker->randomDigit,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'deleted_at' => null,
    ];
});