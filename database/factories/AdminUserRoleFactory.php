<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\AdminUserRole::class, function (Faker\Generator $faker) {
    return [
        'admin_user_id' => 0,
        'role'          => str_random(10),
    ];
});
