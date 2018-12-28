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
        'group' => true,
        'name' => 'architect::plugins.topbar.menu'
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
        "route" => 'medias.index',
        "label" => 'architect::header.media',
        "patterns" => [
            'architect/medias*'
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
