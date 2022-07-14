<?php

$factory->define(App\Models\Organiser::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'about' => $faker->text,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'facebook' => 'https://facebook.com/organizer-profile',
        'twitter' => 'https://twitter.com/organizer-profile',
        'logo_path' => 'path/to/logo',
        'is_email_confirmed' => 0,
    ];
});
