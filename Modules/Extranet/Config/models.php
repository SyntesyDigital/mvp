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
          'telephone'
        ],
        'rules' => [
          'required',
          'minCharacters',
          'maxCharacters',
          'searchable',
          'sortable',
        ],
        'settings' => [
          'format',
          'maxLength',
        ]
      ],
      'number' => [
        'mapping' => 'num',
        'identifier' => 'number',
        'label' => 'Number',
        'icon' => 'fa fa-calculator',
        'formats' => [
          'price',
          'price_with_decimals',
        ],
        'rules' => [
          'required',
          'searchable',
          'sortable',
        ],
        'settings' => [
          'format',
        ]
      ],
      'date' => [
        'mapping' => 'date',
        'identifier' => 'date',
        'label' => 'Date',
        'icon' => 'far fa-calendar',
        'formats' => [
          'day_month_year',
          'month_year',
          'year'
        ],
        'rules' => [
          'required',
          'searchable',
          'sortable',
        ],
        'settings' => [
          'format',
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
          'required',
          'searchable',
          'sortable',
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
        ],
        'rules' => [
          'required',
          'searchable',
          'sortable',
        ],
        'settings' => [
          'ws' => ''
        ]
      ],
      'richtext' => [
        'mapping' => 'richtext',
        'identifier' => 'richtext',
        'label' => 'Rich Text',
        'icon' => 'fas fa-align-left',
        'formats' => [
        ],
        'rules' => [
          'required',
          'minCharacters',
          'maxCharacters',
          'searchable',
          'sortable',
        ],
        'settings' => [
          'ws' => ''
        ]
      ]
    ]
];
