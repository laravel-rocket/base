<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\File::class, function (Faker\Generator $faker) {
    return [
        'url'                => $faker->url,
        'title'              => null,
        'entity_type'        => \Illuminate\Support\Str::random(10),
        'entity_id'          => 0,
        'storage_type'       => \Illuminate\Support\Str::random(10),
        'file_category_type' => \Illuminate\Support\Str::random(10),
        'file_type'          => null,
        's3_key'             => \Illuminate\Support\Str::random(10),
        's3_bucket'          => \Illuminate\Support\Str::random(10),
        's3_region'          => \Illuminate\Support\Str::random(10),
        's3_extension'       => \Illuminate\Support\Str::random(10),
        'media_type'         => \Illuminate\Support\Str::random(10),
        'format'             => \Illuminate\Support\Str::random(10),
        'original_file_name' => $faker->name,
        'file_size'          => 0,
        'width'              => 0,
        'height'             => 0,
        'thumbnails'         => null,
        'is_enabled'         => true,
    ];
});
