<?php

return [
    'errors'         => [
        'unknown'             => [
            'code'       => 1000,
            'message'    => 'Unknown Error',
            'statusCode' => 400,
        ],
        'notFound'            => [
            'code'       => 1001,
            'message'    => 'Not Found',
            'statusCode' => 400,
        ],
        'authFailed'          => [
            'code'       => 1002,
            'message'    => 'Auth Failed',
            'statusCode' => 401,
        ],
        'signInRequired'      => [
            'code'       => 1003,
            'message'    => 'Sign In Required',
            'statusCode' => 401,
        ],
        'operationNotAllowed' => [
            'code'       => 1004,
            'message'    => 'You can not do this operation',
            'statusCode' => 403,
        ],
        'severError'          => [
            'code'       => 1005,
            'message'    => 'Server error',
            'statusCode' => 500,
        ],
        'wrongParameter'      => [
            'code'       => 1006,
            'message'    => 'Wrong Parameters',
            'statusCode' => 400,
        ],
    ],
    'validateErrors' => [],
    'headers'        => [
        'locale'    => 'X-ROCKET-LOCALE',
        'version'   => 'X-ROCKET-VERSION',
        'osVersion' => 'X-ROCKET-OS-VERSION',
        'osType'    => 'X-ROCKET-OS-TYPE',
    ],
];
