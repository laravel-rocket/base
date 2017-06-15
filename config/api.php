<?php

return [
    'errors'  => [
        'unknown'        => [
            'code'       => 1000,
            'message'    => 'Unknown Error',
            'statusCode' => 400,
        ],
        'notFound'       => [
            'code'       => 1001,
            'message'    => 'Not Found',
            'statusCode' => 400,
        ],
        'authFailed'     => [
            'code'       => 1002,
            'message'    => 'Auth Failed',
            'statusCode' => 401,
        ],
        'signInFailed'     => [
            'code'       => 1012,
            'message'    => 'Please check username or password',
            'statusCode' => 401,
        ],
        'signInRequired' => [
            'code'       => 1003,
            'message'    => 'Sign In Required',
            'statusCode' => 401,
        ],
        'wrongParameter' => [
            'code'        => 1004,
            'message'     => 'Wrong Parameters',
            'statusCode' => 400,
        ],
        'severError'     => [
            'code'       => 1005,
            'message'    => 'Server error',
            'statusCode' => 500,
        ],
        'saveError'     => [
            'code'       => 1006,
            'message'    => 'Save error',
            'statusCode' => 500,
        ],
        'operationNotAllowed'     => [
            'code'       => 1007,
            'message'    => 'You can not do this operation',
            'statusCode' => 403,
        ],
    ],
    'validateErrors' => [
    ],
    'headers' => [
        'locale'    => 'X-ROCKET-LOCALE',
        'version'   => 'X-ROCKET-VERSION',
        'osType'    => 'X-ROCKET-OS-VERSION',
        'osVersion' => 'X-ROCKET-OS-TYPE',
    ],
];
