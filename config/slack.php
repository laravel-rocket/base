<?php

return [
    'targetEnvironment' => ['production'],
    'webHookUrl'        => env('SLACK_WEB_HOOK_URL'),
    'types'             => [
        'serious-alert' => [
            'channel'  => '#random',
            'username' => 'Alert Bot',
            'icon'     => ':no_entry_sign:',
            'color'    => 'bad',
        ],
    ],
    'default'           => [
        'channel'  => '#random',
        'username' => 'Bot',
        'icon'     => ':smile:',
        'color'    => 'good',
    ],
];
