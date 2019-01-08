<?php

return [
    'storage' => 'public/customers/:id/files',
    'rules' => [
        'name' => 'required',
        'phone_number' => 'required',
        'email' => 'required|email',
    ],
    'messages' => [
        'name.required' => 'Le champ titre est obligatoire',
        'phone_number.required' => 'Le champ téléphone est obligatoire',
        'email.required' => 'Le champ email est obligatoire',
        'email.email' => 'Le champs email n\'est pas valide',
    ],
    'form' => [
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
                        'title' => 'Utilisateurs',
                        'subtitle' => '',
                        'childs' => [
                            [
                                'type' => 'col',
                                'class' => 'col-md-12',
                                'childs' => [
                                    [
                                        'type' => 'field',
                                        'input' => 'customer_users',
                                        'identifier' => 'customer_users',
                                        'name' => 'customer_users',
                                        'label' => '',
                                        'config' => [
                                            'type' => 'ajax',
                                            'route' => 'rrhh.admin.customers.users.data'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
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
              'type' => 'box',
              'title' => 'Données du client',
              'subtitle' => '',
              'childs' => [
                  [
                      'type' => 'col',
                      'class' => 'col-md-6',
                      'childs' => [
                          [
                              'type' => 'field',
                              'input' => 'text',
                              'identifier' => 'name',
                              'name' => 'name',
                              'label' => 'Enterprise'
                          ],

                          [
                              'type' => 'field',
                              'input' => 'text',
                              'identifier' => 'firstname',
                              'name' => 'firstname',
                              'label' => 'Référent Prénom'
                          ],

                          [
                              'type' => 'field',
                              'input' => 'text',
                              'identifier' => 'lastname',
                              'name' => 'lastname',
                              'label' => 'Référent Nom'
                          ],

                          [
                              'type' => 'field',
                              'input' => 'text',
                              'identifier' => 'phone_number',
                              'name' => 'phone_number',
                              'label' => 'Téléphone'
                          ],
                      ],
                  ],

                  [
                      'type' => 'col',
                      'class' => 'col-md-6',
                      'childs' => [
                          [
                              'type' => 'field',
                              'input' => 'text',
                              'identifier' => 'email',
                              'name' => 'email',
                              'label' => 'Email'
                          ],

                          [
                              'type' => 'field',
                              'input' => 'text',
                              'identifier' => 'address',
                              'name' => 'address',
                              'label' => 'Adresse'
                          ],

                          [
                              'type' => 'field',
                              'input' => 'text',
                              'identifier' => 'postcode',
                              'name' => 'postcode',
                              'label' => 'Code postal'
                          ],

                          [
                              'type' => 'field',
                              'input' => 'text',
                              'identifier' => 'city',
                              'name' => 'city',
                              'label' => 'Ville'
                          ],
                      ],
                  ],

              ]
          ],

          [
              'type' => 'br',
          ],

          [
              'type' => 'box',
              'title' => 'Documents du client',
              'subtitle' => '',
              'childs' => [
                [
                  'type' => 'col',
                  'class' => 'col-md-12',
                  'childs' => [
                      [
                          'type' => 'field',
                          'input' => 'customer_documents',
                          'identifier' => 'customer_documents',
                          'name' => 'customer_documents',
                          'label' => 'customer_documents',
                          'config' => [
                              'type' => 'ajax',
                              'route' => 'rrhh.admin.customers.documents.data'
                          ]
                      ]
                  ]
                ]

              ]
          ]

      ],

    ]
];
