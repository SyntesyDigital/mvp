<?php

return [
    "back" => [
        'right' => [

              // -----------------------------------------------------------------//
              //      RIGHT COL
              // -----------------------------------------------------------------//

              [
                  'type' => 'col',
                  'class' => 'col-md-12',
                  'childs' => [
                      [
                          'type' => 'box',
                          'title' => 'ABONEMMENT',
                          'subtitle' => '',
                          'childs' => [
                              [
                                  'type' => 'field',
                                  'input' => 'text',
                                  'identifier' => 'created_at',
                                  'name' => 'created_at',
                                  'label' => 'Créé le',
                                  'readonly' => 'readonly'
                              ]
                          ]
                      ],
                  ],
              ],

              [
                  'type' => 'br',
              ],
        ],

        'left' => [

              // -----------------------------------------------------------------//
              //      LEFT COL
              // -----------------------------------------------------------------//

              [
                  'type' => 'col',
                  'class' => 'col-md-12',
                  'childs' => [
                      [
                          'type' => 'box',
                          'title' => 'ABONEMMENT',
                          'subtitle' => '',
                          'childs' => [
                              [
                                  'type' => 'field',
                                  'input' => 'text',
                                  'identifier' => 'allergy',
                                  'name' => 'allergy',
                                  'label' => 'Alérgies'
                              ],
                              [
                                  'type' => 'field',
                                  'input' => 'select',
                                  'identifier' => 'delivery_mode_id',
                                  'name' => 'delivery_mode_id',
                                  'label' => 'Mode de livraison',
                                  'options' => []
                              ],
                          ]
                      ],
                  ],
              ],

              [
                  'type' => 'br',
              ],
        ]
    ],
    "front" => [

    ]
];
