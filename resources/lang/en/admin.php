<?php

return [
    'menu'     => [
        'dashboard'          => 'Dashboard',
        'admin_users'        => 'Admin Users',
        'users'              => 'Users',
        'site-configuration' => 'Site Configuration',
    ],
    'messages' => [
        'general' => [
            'update_success' => 'Successfully updated.',
            'create_success' => 'Successfully created.',
            'delete_success' => 'Successfully deleted.',
        ],
    ],
    'errors'   => [
        'general'  => [
            'save_failed' => 'Failed To Save. Please contact with developers',
        ],
        'requests' => [
            'me' => [
                'email'    => [
                    'required' => 'Email Required',
                    'email'    => 'Email is not valid',
                ],
                'password' => [
                    'min' => 'Password need at least 6 letters',
                ],
            ],
        ],
    ],
    'pages'    => [
        'common'      => [
            'buttons' => [
                'create'          => 'Create New',
                'edit'            => 'Edit',
                'save'            => 'Save',
                'delete'          => 'Delete',
                'cancel'          => 'Cancel',
                'add'             => 'Add',
                'preview'         => 'Preview',
                'forgot_password' => 'Send Me Email!',
                'reset_password'  => 'Reset Password',
            ],
        ],
        'auth'        => [
            'buttons'  => [
                'sign_in' => 'Sign In',
                'sign_up' => 'Sign Up',
                'reset'   => 'Reset Password',
                'forgot'  => 'Send Reset Email',
            ],
            'messages' => [
                'remember_me'     => 'Remember Me',
                'forgot_password' => 'Forget Password',
                'email'           => 'Email',
                'password'        => 'Password',
            ],
        ],
        'users'       => [
            'columns' => [
                'name'          => 'Name',
                'email'         => 'Email',
                'password'      => 'Password',
                'profile_image' => 'Profile Image',
            ],
        ],
        'admin-users' => [
            'columns' => [
                'name'          => 'Name',
                'email'         => 'Email',
                'password'      => 'Password',
                'profile_image' => 'Profile Image',
            ],
        ],
        /* NEW PAGE STRINGS */
    ],
    'roles'    => [
        'super_user' => 'Super User',
        'site_admin' => 'Site Administrator',
    ],
];
