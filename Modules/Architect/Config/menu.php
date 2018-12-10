<?php

return [
    [
        "route" => 'dashboard',
        "label" => Lang::get('architect::header.home'),
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
        "route" => 'typologies',
        "label" => Lang::get('architect::header.typology'),
        "patterns" => [
            'architect/typologies*'
        ],
        "roles" => [
            'admin'
        ]
    ],

    [
        "route" => 'contents',
        "label" => Lang::get('architect::header.contents'),
        "patterns" => [
            'architect/contents*'
        ],
        "roles" => []
    ],

    [
        "route" => 'medias.index',
        "label" => Lang::get('architect::header.media'),
        "patterns" => [
            'architect/medias*'
        ],
        "roles" => []
    ],

    [
        "route" => 'settings',
        "label" => Lang::get('architect::header.configuration'),
        "patterns" => [
            'architect/settings*'
        ],
        "roles" => [
            'admin'
        ]
    ],
];
