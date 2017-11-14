<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\File::class, function (Faker\Generator $faker) {
    return [
        'url'                => $faker->url,
        'title'              => $faker->sentence,
        'entity_type'        => '',
        'entity_id'          => 0,
        'storage_type'       => '',
        'file_type'          => '',
        'file_category_type' => '',
        's3_key'             => $faker->word,
        's3_bucket'          => '',
        's3_region'          => '',
        's3_extension'       => '',
        'media_type'         => '',
        'format'             => '',
        'file_size'          => 0,
        'original_file_name' => $faker->word,
        'width'              => 0,
        'height'             => 0,
        'is_enabled'         => true,
    ];
});
