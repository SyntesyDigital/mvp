<?php

return [
    'sinister' => [
      'rules' => [
          'broker_number' => 'required',
          'insurer_number' => 'required',
          'customer_reference' => 'required',
          'reassureur_reference' => 'required',
          'apperteur_reference' => 'required',
          'ref_expert' => 'required',
          'occurrence_date' => 'required',
          'declaration_date' => 'required',
          'close_date' => 'required',
          'type' => 'required',
          'responsability' => 'required',
          'nature' => 'required',
          'circumstance' => 'required',

      ],
      'GET' => [
        //json to match fields. Math with identifier
      ],
      'PUT' => [
        //create fields match
      ],
      'POST' => [
        //edit fields
      ],
      'fields' => [
        [
          'type' => 'field',
          'input' => 'text',  //
          'identifier' => 'Nocbt',
          'name' => 'broker_number',
          'label' => 'form.sinister.label.broker_number',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'text',  //
          'identifier' => 'Nocbt',
          'name' => 'insurer_number',
          'label' => 'form.sinister.label.insurer_number',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'text',  //
          'identifier' => 'Nocbt',
          'name' => 'customer_reference',
          'label' => 'form.sinister.label.customer_reference',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'text',  //
          'identifier' => 'Nocbt',
          'name' => 'reassureur_reference',
          'label' => 'form.sinister.label.reassureur_reference',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'text',  //
          'identifier' => 'Nocbt',
          'name' => 'apperteur_reference',
          'label' => 'form.sinister.label.apperteur_reference',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'text',  //
          'identifier' => 'Nocbt',
          'name' => 'ref_expert',
          'label' => 'form.sinister.label.ref_expert',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'date',  //
          'identifier' => 'Nocbt',
          'name' => 'occurrence_date',
          'label' => 'form.sinister.label.occurrence_date',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'date',  //
          'identifier' => 'Nocbt',
          'name' => 'declaration_date',
          'label' => 'form.sinister.label.declaration_date',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'date',  //
          'identifier' => 'Nocbt',
          'name' => 'close_date',
          'label' => 'form.sinister.label.close_date',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'list',  //
          'identifier' => 'types',
          'name' => 'type',
          'label' => 'form.sinister.label.type',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'list',  //
          'identifier' => 'responsabilities',
          'name' => 'responsability',
          'label' => 'form.sinister.label.responsability',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'list',  //
          'identifier' => 'nature',
          'name' => 'nature',
          'label' => 'form.sinister.label.nature',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'text',  //
          'identifier' => 'circumstance',
          'name' => 'circumstance',
          'label' => 'form.sinister.label.circumstance',
          'placeholder' => '',
          'default' => ''
        ]

      ]
    ],
    'police' => [

    ],
    'customer' => [

    ],
    'bonus' => [

    ]
];
