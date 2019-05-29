<?php

return [
    [
        "route" => 'dashboard',
        "label" => 'architect::header.home',
        "patterns" => [
            'architect'
        ],
        "roles" => []
    ],

    [
        "route" => 'extranet.extranet.index',
        "label" => 'extranet::header.extranet',
        "patterns" => [
            'architect/extranet*',
        ],
        "roles" => []
    ],

    [
        "route" => 'contents',
        "label" => 'architect::header.contents',
        "patterns" => [
            'architect/contents*'
        ],
        "roles" => ['admin']
    ],

    [
        "route" => 'settings',
        "label" => 'architect::header.configuration',
        "patterns" => [
            'architect/settings*'
        ],
        "roles" => [
            'admin'
        ]
    ],
];
