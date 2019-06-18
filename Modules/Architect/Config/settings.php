<?php

return [
    [
        "route" => 'extranet.elements.index',
        "icon" => "fa-sitemap",
        "label" => 'Éléments',
        "roles" => [ROLE_ADMIN]
    ],
    /*[
    "route" => 'extranet.models.index',
    "icon" => "fa-sitemap",
    "label" => Lang::get('architect::settings.models'),
    "roles" => ["admin"]
],*/
    [
        "route" => 'typologies',
        "icon" => "fa-th",
        "label" => Lang::get('architect::settings.typologies'),
        "roles" => [ROLE_ADMIN]
    ],

    [
        "route" => 'translations',
        "icon" => "fa-list-alt",
        "label" => Lang::get('architect::settings.translations'),
    ],

    [
        "route" => 'extranet.admin.sitelists.index',
        "icon" => "fa-bars",
        "label" => Lang::get('architect::settings.list'),
    ],

  /*  [
        "route" => 'languages',
        "icon" => "fa-flag",
        "label" => Lang::get('architect::settings.languages'),
    ],*/

    [
        "route" => 'menu.index',
        "icon" => "fa-list",
        "label" => Lang::get('architect::settings.menu'),
    ],

    [
        "route" => 'pagelayouts',
        "icon" => "fa-columns",
        "label" => Lang::get('architect::settings.templates'),
    ],
  /*  [
        "route" => 'users',
        "icon" => "fa-users",
        "label" => Lang::get('architect::settings.users'),
    ],*/
    [
        "route" => 'extranet.routes_parameters.index',
        "icon" => "fa-bars",
        "label" => Lang::get('architect::settings.routes_parameters'),
    ]
];
