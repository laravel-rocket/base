<?php

return [
    'storage' => [
        'local' => [
            'path' => realpath(base_path('public/uploads')),
            'url'  => '/uploads',
        ],
        's3' => [
            'region'  => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
        ],
        'default' => env('STORAGE_TYPE', 'local'),
    ],
    'acceptable' => [
        'file' => [
            'application/pdf'          => 'pdf',
            'application/octet-stream' => '',
            'application/zip'          => 'zip',
            'text/plain'               => 'txt',
            'image/png'                => 'png',
            'image/jpeg'               => 'jpg',
            'image/gif'                => 'gif',
        ],
        'image' => [
            'image/png'  => 'png',
            'image/jpeg' => 'jpg',
            'image/gif'  => 'gif',
        ],
    ],
    'categories' => [
        'default-file' => [
            'name'       => 'default',
            'type'       => 'file',
            'size'       => [300, 300],
            'thumbnails' => [],
            'seedPrefix' => 'default',
        ],
        'default-image' => [
            'name'       => 'default',
            'type'       => 'image',
            'size'       => [800, 0],
            'thumbnails' => [],
            'seedPrefix' => 'default',
            'format'     => 'jpeg',
        ],
        'profile-image' => [
            'name'       => 'profile-image',
            'type'       => 'image',
            'size'       => [300, 300],
            'thumbnails' => [],
            'seedPrefix' => 'profile',
            'format'     => 'jpeg',
        ],
    ],
];
