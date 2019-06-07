<?php

return [
    [
        "route" => 'extranet.elements.index',
        "icon" => "fa-sitemap",
        "label" => 'Éléments',
        "roles" => [ROLE_ADMIN]
    ],
    [
        "route" => 'typologies',
        "icon" => "fa-th",
        "label" => Lang::get('architect::settings.typologies'),
        "roles" => [ROLE_ADMIN]
    ],

    [
        "route" => 'languages',
        "icon" => "fa-flag",
        "label" => Lang::get('architect::settings.languages'),
    ],

    [
        "route" => 'translations',
        "icon" => "fa-list-alt",
        "label" => Lang::get('architect::settings.translations'),
    ],

    [
        "route" => 'menu.index',
        "icon" => "fa-list",
        "label" => Lang::get('architect::settings.menu'),
    ],

    [
        "route" => 'pagelayouts',
        "icon" => "fa-columns",
        "label" => Lang::get('architect::settings.templates'),
    ]
];
