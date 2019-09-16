<?php

return [
    [
        "route" => 'extranet.elements.index',
        "icon" => "fa-sitemap",
        "label" => 'Éléments',
        "roles" => [ROLE_SYSTEM]
    ],

    [
        "route" => 'typologies',
        "icon" => "fa-th",
        "label" => Lang::get('architect::settings.typologies'),
        "roles" => [ROLE_SYSTEM]
    ],

    [
        "route" => 'translations',
        "icon" => "fa-list-alt",
        "label" => Lang::get('architect::settings.translations'),
        "roles" => [ROLE_SYSTEM,ROLE_SUPERADMIN]
    ],

    [
        "route" => 'extranet.admin.sitelists.index',
        "icon" => "fa-bars",
        "label" => Lang::get('architect::settings.list'),
        "roles" => [ROLE_SYSTEM]
    ],

    [
        "route" => 'menu.index',
        "icon" => "fa-list",
        "label" => Lang::get('architect::settings.menu'),
        "roles" => [ROLE_SYSTEM,ROLE_SUPERADMIN]
    ],

    [
        "route" => 'pagelayouts',
        "icon" => "fa-columns",
        "label" => Lang::get('architect::settings.templates'),
        "roles" => [ROLE_SYSTEM,ROLE_SUPERADMIN]
    ],

    [
        "route" => 'extranet.routes_parameters.index',
        "icon" => "fa-bars",
        "label" => Lang::get('architect::settings.routes_parameters'),
        "roles" => [ROLE_SYSTEM]
    ]
];
