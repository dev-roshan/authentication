<?php
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
            'model' => \App\Model\User::class
        ]
    ]
];
