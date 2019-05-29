<?php

return [
    'sinister' => [
      'method' => 'sinister',
      'rules' => [
          'occurrence_date' => 'required',
          'nature' => 'required',
      ],
      'POST' => [
        'idPol' => '11000145',
        'numSoc' => 'CI01',
        'mouvement' => 'OUVSIN',
        'motif' => 'EXTSIN',
        'numAuto' => 'O',
        'numAutoCie' =>'',

        'type' => '',  //type list
        'txResp' => '',  //responsability list
        'circonstance' => '',  //nature from boby, required

        'causeCirconstance' => '',  //circumstance
        'dateOuverture' => '_now',  //codes to recognize internal functions
        'dateSurvenance' => '', //occurrence_date, required
        'dateDeclaration' => '', //declaration_date
        'dateCloture' => '', //close_date
        'dommages'=>'test',
        'codeProduit'=>'AUTO',
        'codeCie' =>"ALZ_CI",
        'libMvt'=>'Ouverture Sinistre',
        'libMotif'=>'Prueba-declaration Extranet',
        'loadAssure'=>'1',
        'listInfos' => [
           ['key'=>'DECLARANT_NOM','value'=>''],
           ['key'=>'DECLARANT_PRENOM','value'=>''],
           ['key'=>'DECLARANT_MAIL','value'=>''],
        ],
      ],
      'fields' => [
        [
          'type' => 'field',  // field type for layout
          'input' => 'text',  // field input type for form visualization
          'identifier' => 'listInfos.DECLARANT_NOM',  //field relative to VEOS POST
          'name' => 'first_name', //form name, relative to rules
          'label' => 'form.customer.label.first_name',  //label to internationalization
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'text',  //
          'identifier' => 'listInfos.DECLARANT_PRENOM',
          'name' => 'last_name',
          'label' => 'form.customer.label.last_name',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'text',  //
          'identifier' => 'listInfos.DECLARANT_MAIL',
          'name' => 'email',
          'label' => 'form.customer.label.email',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'date',
          'identifier' => 'dateSurvenance', //referece to VEOS
          'name' => 'occurrence_date',
          'label' => 'form.sinister.label.occurrence_date',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'date',  //
          'identifier' => 'dateDeclaration',
          'name' => 'declaration_date',
          'label' => 'form.sinister.label.declaration_date',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'date',  //
          'identifier' => 'dateCloture',
          'name' => 'close_date',
          'label' => 'form.sinister.label.close_date',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'list',  //
          'identifier' => 'type',
          'name' => 'type',
          'label' => 'form.sinister.label.type',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'list',  //
          'identifier' => 'txResp',
          'name' => 'responsability',
          'label' => 'form.sinister.label.responsability',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'boby',  //defines filled by boby, needs more configuration
          'identifier' => 'circonstance',
          'name' => 'nature',
          'label' => 'form.sinister.label.nature',
          'placeholder' => '',
          'default' => ''
        ],
        [
          'type' => 'field',
          'input' => 'textarea',  //
          'identifier' => 'causeCirconstance',
          'name' => 'circumstance',
          'label' => 'form.sinister.label.circumstance',
          'placeholder' => '',
          'default' => ''
        ],
      ],
    ],
    'personee' => [

    ],
    'contrat' => [

    ],
    'document' => [

    ],
    'quittance' => [

    ]
];
