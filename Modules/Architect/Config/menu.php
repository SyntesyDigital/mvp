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
        "route" => 'extranet.admin.offers.index',
        "label" => 'extranet::header.offers',
        "patterns" => [
            'architect/offers*',
            'architect/tags*'
        ],
        "roles" => []
    ],

    /*
    [
        'group' => true,
        'name' => 'architect::plugins.topbar.menu'
    ],
    */
    [
        "route" => 'extranet.admin.candidates.index',
        "label" => 'extranet::header.candidates',
        "patterns" => [
            'architect/candidates*'
        ],
        "roles" => ['admin']
    ],
    [
        "route" => 'extranet.admin.customers.index',
        "label" => 'extranet::header.customers',
        "patterns" => [
            'architect/customers*'
        ],
        "roles" => ['admin']
    ],
    [
        "route" => 'contents',
        "label" => 'architect::header.contents',
        "patterns" => [
            'architect/contents*'
        ],
        "roles" => ['admin']
    ],

  /*  [
        "route" => 'medias.index',
        "label" => 'architect::header.media',
        "patterns" => [
            'architect/medias*'
        ],
        "roles" => ['admin']
    ],
*/
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
