<?php

return [

    [
        "route" => 'rrhh.admin.offers.index',
        "label" => Lang::get('architect::header.offers'),
        "patterns" => [
            'architect/offers*',
            'architect/candidates*',
            'architect/customers*',
            'architect/tags*'
        ],
        "roles" => []
    ],

];
