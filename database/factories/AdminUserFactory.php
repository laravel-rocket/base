<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\AdminUser::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'             => $faker->name,
        'email'            => $faker->unique()->safeEmail,
        'password'         => $password ?: $password = bcrypt('secret'),
        'profile_image_id' => 0,
        'remember_token'   => '',
    ];
});
