<?php

// return [
//     'ROLE_CORRESPONDANT' => 1,
//     'ROLE_CLIENT_INTERNATIONAL' => 2,
//     'ROLE_COURTIER_MASTER' => 3,
//     'ROLE_CLIENT_LOCAL' => 4,
//     'ROLE_DIRECTION_BUREAU' => 5,
//     'ROLE_HOLDING' => 6,
//     'ROLE_APPORTEUR' => 7,
//     'ROLE_CLIENT_FLOTTE' => 8,
// ];

return [
    'default' => [
        'customers' => [
            'read'=> true,
            'create' => true,
            'update' => true,
            'show-group' => false
        ],
        'policies' => [
            'read'=> true,
            'create' => true,
            'update' => true,
            'show-policy-bonus' => true,
            'show-group' => false,
            'show-country' => false,
        ],
        'bonus' => [
            'read'=> true,
            'create' => true,
            'update' => true,
            'delete' => true,
            'show-amount-extra' => true,
            'show-currency' => false,
            'show-country' => false,
            'show-com' => true,
            'show-group' => false,
            'edit-premium' => true
        ],
        'risks' => [
            'read'=> true,
            'create' => true,
            'update' => true
        ],
        'sinisters' => [
            'read'=> true,
            'create' => true,
            'update' => true
        ],
        'sinthesys' => [
            'read'=> true,
            'create' => true,
            'update' => true,
            'show-group' => false
        ],
        'analyzes' => [
            'read' => false
        ],
        'perfil' => [
            'edit-country' => true
        ],
    ],

    'ROLE_CORRESPONDANT' => [
        'customers' => [
            'read'=> true,
            'create' => true,
            'update' => true,
            'show-group' => false
        ],
        'policies' => [
            'read'=> true,
            'create' => true,
            'update' => true,
            'show-policy-bonus' => true,
            'show-group' => false,
            'show-country' => false,
        ],
        'bonus' => [
            'read'=> true,
            'create' => true,
            'update' => true,
            'delete' => true,
            'show-amount-extra' => true,
            'show-currency' => false,
            'show-country' => false,
            'show-com' => true,
            'show-group' => false,
            'edit-premium' => true
        ],
        'risks' => [
            'read'=> true,
            'create' => true,
            'update' => true
        ],
        'sinisters' => [
            'read'=> true,
            'create' => true,
            'update' => true
        ],
        'sinthesys' => [
            'read'=> true,
            'create' => true,
            'update' => true,
            'show-group' => false
        ],
        'analyzes' => [
            'read' => false
        ],
        'perfil' => [
            'edit-country' => true
        ],
    ],

    'ROLE_CLIENT_INTERNATIONAL' => [
        'customers' => [
            'read' => true,
            'show-currency' => true
        ],
        'policies' => [
            'read' => true,
            'create'=> false,
            'show-rate' => true,
            'show-currency' => true,
            'show-country' => true,
            'show-group' => true,
        ],
        'bonus' => [
            'read' => true,
            'show-currency' => true,
            'show-country' => true,
            'edit-premium' => false
        ],
        'risks' => [
            'read' => true
        ],
        'sinisters' => [
            'read' => true,
            'show-country' => true
        ],
        'sinthesys' => [
            'read'=> true
        ],
        'analyzes' => [
            'read' => true
        ],
        'perfil' => [
            'edit-country' => false
        ],
    ],

    'ROLE_DIRECTION_BUREAU' => [
        'customers' => [
            'read' => true,
            'show-currency' => true,
            'show-group' => true
        ],
        'policies' => [
            'read' => true,
            'create'=> true,
            'show-rate' => true,
            'show-currency' => true,
            'show-group' => true
        ],
        'bonus' => [
            'read' => true,
            'show-currency' => true,
            'show-country' => true,
            'show-group' => true,
            'edit-premium' => true
        ],
        'risks' => [
            'read' => true
        ],
        'sinisters' => [
            'read' => true,
            'show-country' => true,
            'show-group' => true
        ],
        'sinthesys' => [
            'read'=> true
        ],
        'analyzes' => [
            'read' => true
        ],
        'perfil' => [
            'edit-country' => false
        ],
    ],

    'ROLE_HOLDING' => [
        'customers' => [
            'read' => true,
            'show-currency' => true,
            'show-group' => true
        ],
        'policies' => [
            'read' => true,
            'show-rate' => true,
            'show-currency' => true,
            'show-group' => true
        ],
        'bonus' => [
            'read' => true,
            'show-currency' => true,
            'show-country' => true,
            'show-group' => true,
            'edit-premium' => false
        ],
        'risks' => [
            'read' => true
        ],
        'sinisters' => [
            'read' => true,
            'show-country' => true,
            'show-group' => true
        ],
        'sinthesys' => [
            'read'=> true
        ],
        'analyzes' => [
            'read' => true
        ],
        'perfil' => [
            'edit-country' => false
        ],
    ],

    'ROLE_COURTIER_MASTER' => [
        'customers' => [
            'read' => true,
            'show-currency' => true
        ],
        'policies' => [
            'read' => true,
            'create'=> true,
            'show-rate' => true,
            'show-currency' => true,
            'show-country' => true,
            'show-group' => true,
        ],
        'bonus' => [
            'read' => true,
            'show-currency' => true,
            'show-country' => true,
            'edit-premium' => false
        ],
        'risks' => [
            'read' => true
        ],
        'sinisters' => [
            'read' => true,
            'show-country' => true
        ],
        'sinthesys' => [
            'read'=> true
        ],
        'analyzes' => [
            'read' => true
        ],
        'perfil' => [
            'edit-country' => false
        ],
    ],

    'ROLE_CLIENT_LOCAL' => [
        'customers' => [
            'read' => true,
            'show-currency' => true
        ],
        'policies' => [
            'read' => true,
            'create'=> true,
            'show-rate' => true,
            'show-currency' => true,
            'show-country' => true,
            'show-group' => true,
        ],
        'bonus' => [
            'read' => true,
            'show-currency' => true,
            'show-country' => true,
            'edit-premium' => true
        ],
        'risks' => [
            'read' => true
        ],
        'sinisters' => [
            'read' => true,
            'show-country' => true
        ],
        'sinthesys' => [
            'read'=> true
        ],
        'analyzes' => [
            'read' => true
        ],
        'perfil' => [
            'edit-country' => false
        ],
    ],
];
