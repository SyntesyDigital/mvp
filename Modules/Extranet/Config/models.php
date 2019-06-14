<?php

return [
    'fields' => [
      'text' => [
        'mapping' => 'texte',
        'identifier' => 'text',
        'label' => 'Text',
        'icon' => 'fa fa-font',
        'formats' => [
          'email',
          'color'
        ],
        'rules' => [
          'isRequired',
        ],
        'settings' => [
          'maxLength',
        ]
      ],
      'number' => [
        'mapping' => 'num',
        'identifier' => 'number',
        'label' => 'Number',
        'icon' => 'fa fa-calculator',
        'formats' => [
          'id',
          'price',
          'quantity',
        ],
        'rules' => [
          'isRequired'
        ],
        'settings' => [
        ]
      ],
      'date' => [
        'mapping' => 'date',
        'identifier' => 'date',
        'label' => 'Date',
        'icon' => 'fa fa-calendar',
        'formats' => [
          'dayMonthYear',
          'monthYear',
          'year',
          'text'
        ],
        'rules' => [
          'dateFormat',
          'isRequired'
        ],
        'settings' => [
        ]
      ],
      'select' => [
        'mapping' => 'select',
        'identifier' => 'select',
        'label' => 'Boby List',
        'icon' => 'fas fa-list-ul',
        'formats' => [
        ],
        'rules' => [
        ],
        'settings' => [
          'ws' => ''
        ]
      ],
      'file' => [
        'mapping' => 'file',
        'identifier' => 'file',
        'label' => 'File',
        'icon' => 'fas fa-paperclip',
        'formats' => [
        ]
      ],
      'richtext' => [
        'mapping' => 'richtext',
        'identifier' => 'richtext',
        'label' => 'Rich Text',
        'icon' => 'fas fa-align-left',
        'formats' => [
        ]
      ]
    ]
];
