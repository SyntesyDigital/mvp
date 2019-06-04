<?php

return [
    [
        "route" => 'extranet.elements.index',
        "icon" => "fa-sitemap",
        "label" => Lang::get('architect::settings.elements'),
        "roles" => ["admin"]
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
        "roles" => ["admin"]
    ],

    [
        "route" => 'translations',
        "icon" => "fa-list-alt",
        "label" => Lang::get('architect::settings.translations'),
    ],

    [
        "route" => 'extranet.admin.sitelists.index',
        "icon" => "fa-reorder",
        "label" => Lang::get('architect::settings.list'),
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
    ],

    [
        "route" => 'users',
        "icon" => "fa-users",
        "label" => Lang::get('architect::settings.users'),
    ],
    [
        "route" => 'extranet.routes_parameters.index',
        "icon" => "fa-reorder",
        "label" => Lang::get('architect::settings.routes_parameters'),
    ]/*,

    [
        "route" => 'languages',
        "icon" => "fa-flag",
        "label" => Lang::get('architect::settings.languages'),
    ]*/
];
