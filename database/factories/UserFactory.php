<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name'             => $faker->name,
        'email'            => $faker->email,
        'password'         => $faker->password,
        'profile_image_id' => 0,
    ];
});
