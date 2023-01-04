<?php

use App\Models\User;
return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
'guards' => [
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],
'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => User::class
        ]
    ]
];
