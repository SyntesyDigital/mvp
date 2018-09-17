<?php

return [
    'hosts' => [
        [
            'host' => env('ELASTICSEARCH_HOST', 'localhost'),
            'port' => env('ELASTICSEARCH_POST', '9200'),
            'scheme' => env('ELASTICSEARCH_SCHEME', 'http'),
            'user' => env('ELASTICSEARCH_USERNAME', ''),
            'pass' => env('ELASTICSEARCH_PASSWORD', ''),
        ]
    ],

    'index' => env('ELASTICSEARCH_INDEX', 'architect')
];
