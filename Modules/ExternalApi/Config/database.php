<?php

return [
    'turisme_external' => [
        'driver' => env('DB_EXTERNAL_CONNECTION', 'mysql'),
        'host' => env('DB_EXTERNAL_HOST', '127.0.0.1'),
        'port' => env('DB_EXTERNAL_PORT', '3306'),
        'database' => env('DB_EXTERNAL_DATABASE', 'forge'),
        'username' => env('DB_EXTERNAL_USERNAME', 'forge'),
        'password' => env('DB_EXTERNAL_PASSWORD', ''),
        'unix_socket' => env('DB_EXTERNAL_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
    ]
];
