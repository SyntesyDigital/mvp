<?php

return [
    "back" => [
        'sidebar' => [

          // -----------------------------------------------------------------//
          //      RIGHT COL
          // -----------------------------------------------------------------//

          [
            'type' => 'box',
            'title' => 'General Settings',
            'identifier' => 'box_2',
            'children' => [
                [
                  'type' => 'col',
                  'class' => 'col-md-12',
                  'children' => [
                    [
                        'type' => 'field',
                        'input' => 'color',
                        'identifier' => 'backPrimary',
                        'name' => 'backPrimary',
                        'label' => 'Primary color'
                    ],
                    [
                        'type' => 'field',
                        'input' => 'color',
                        'identifier' => 'backSecondary',
                        'name' => 'backSecondary',
                        'label' => 'Secondary color'
                    ]
                  ] //end children col
                ],

              ]//en children box
          ]//end box 1



        ],//end sidebar

        'body' => [

              // -----------------------------------------------------------------//
              //      LEFT COL
              // -----------------------------------------------------------------//

              [
                'type' => 'box',
                'title' => 'Header Settings',
                'identifier' => 'box_3',
                'children' => [
                    [
                      'type' => 'col',
                      'class' => 'col-sm-12 col-md-6',
                      'children' =>[
                        [

                            'type' => 'field',
                            'input' => 'image',
                            'identifier' => 'backLogo',
                            'name' => 'backLogo',
                            'label' => 'Logo',
                            'format' => 'medium'
                        ],

                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'backHeaderTextColor',
                            'name' => 'backHeaderTextColor',
                            'label' => 'Text color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'backHeaderBackgroundColor',
                            'name' => 'backHeaderBackgroundColor',
                            'label' => 'Background color'
                        ],

                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'backHeaderRightPartBackgroundHoverColor',
                            'name' => 'backHeaderRightPartBackgroundHoverColor',
                            'label' => 'Right menu hover background color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'backHeaderLogoBackgroundColor',
                            'name' => 'backHeaderLogoBackgroundColor',
                            'label' => 'Logo background color'
                        ]

                      ]
                    ] //end children col
                ],

              ],//end box 1


              [
                'type' => 'box',
                'title' => 'Sidebar Settings',
                'identifier' => 'box_4',
                'children' => [
                    [
                      'type' => 'col',
                      'class' => 'col-md-12',
                      'children' => [
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'backSidebarColor',
                            'name' => 'backSidebarColor',
                            'label' => 'Text color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'backSidebarHoverColor',
                            'name' => 'backSidebarHoverColor',
                            'label' => 'Hover text color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'backSidebarHoverIconBorderColor',
                            'name' => 'backSidebarHoverIconBorderColor',
                            'label' => 'Hover border and icon color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'backSidebarBackgroundColor',
                            'name' => 'backSidebarBackgroundColor',
                            'label' => 'Background color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'backSidebarBackgroundColorHover',
                            'name' => 'backSidebarBackgroundColorHover',
                            'label' => 'Hover Background color'
                        ]
                      ] //end children col
                    ],

                ]//en children box
              ],//end box 1

        ]
    ],
    "front" => [
      'sidebar' => [

        // -----------------------------------------------------------------//
        //      RIGHT COL
        // -----------------------------------------------------------------//

        [
          'type' => 'box',
          'title' => 'General Settings',
          'identifier' => 'box_2',
          'children' => [
              [
                'type' => 'col',
                'class' => 'col-md-12',
                'children' => [
                  [
                      'type' => 'field',
                      'input' => 'font',
                      'identifier' => 'frontFont',
                      'name' => 'frontFont',
                      'label' => 'General Font'
                  ],
                  [
                      'type' => 'field',
                      'input' => 'color',
                      'identifier' => 'frontPrimary',
                      'name' => 'frontPrimary',
                      'label' => 'Primary color'
                  ],
                  [
                      'type' => 'field',
                      'input' => 'color',
                      'identifier' => 'frontSecondary',
                      'name' => 'frontSecondary',
                      'label' => 'Secondary color'
                  ],
                  [
                      'type' => 'field',
                      'input' => 'number',
                      'identifier' => 'frontButtonRadius',
                      'name' => 'frontButtonRadius',
                      'label' => 'Border radius (px)'
                  ]
                ] //end children col
              ],
              //HEADER
              [
                'type' => 'col',
                'class' => 'col-md-12',
                'children' => [
                  [
                      'type' => 'field',
                      'input' => 'color',
                      'identifier' => 'frontHeaderTextColor',
                      'name' => 'frontHeaderTextColor',
                      'label' => 'Header Text color'
                  ],
                  [
                      'type' => 'field',
                      'input' => 'color',
                      'identifier' => 'frontHeaderRightPartBackgroundColor',
                      'name' => 'frontHeaderRightPartBackgroundColor',
                      'label' => 'Header Background color'
                  ]
                ] //end children col
              ],
              //SIDEBAR
              [
                'type' => 'col',
                'class' => 'col-md-12',
                'children' => [
                  [
                      'type' => 'field',
                      'input' => 'color',
                      'identifier' => 'frontSidebarBackgroundColor',
                      'name' => 'frontSidebarBackgroundColor',
                      'label' => 'Sidebar background color'
                  ],
                ] //end children col
              ],
              //BODY
              [
                'type' => 'col',
                'class' => 'col-md-12',
                'children' => [
                  [
                      'type' => 'field',
                      'input' => 'color',
                      'identifier' => 'frontBodyBackgroundColor',
                      'name' => 'frontBodyBackgroundColor',
                      'label' => 'Main background color'
                  ],
                ] //end children col
              ],
            ]//en children box
        ]//end box 1



      ],//end sidebar

      'body' => [

            // -----------------------------------------------------------------//
            //      LEFT COL
            // -----------------------------------------------------------------//

            [
              'type' => 'box',
              'title' => 'Header Settings',
              'identifier' => 'box_3',
              'children' => [

                  [
                    'type' => 'col',
                    'class' => 'col-sm-12 col-md-6',
                    'children' => [
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'frontHeaderTextColor',
                            'name' => 'frontHeaderTextColor',
                            'label' => 'Text color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'frontHeaderRightPartTextColor',
                            'name' => 'frontHeaderRightPartTextColor',
                            'label' => 'Right Part text color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'frontHeaderRightPartBackgroundColor',
                            'name' => 'frontHeaderRightPartBackgroundColor',
                            'label' => 'Background color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'frontHeaderLogoBackgroundColor',
                            'name' => 'frontHeaderLogoBackgroundColor',
                            'label' => 'Logo background color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'frontHeaderButtonColor',
                            'name' => 'frontHeaderButtonColor',
                            'label' => 'Header button color'
                        ],
                        [
                            'type' => 'field',
                            'input' => 'color',
                            'identifier' => 'frontHeaderHoverColor',
                            'name' => 'frontHeaderHoverColor',
                            'label' => 'Header hover button color'
                        ]
                    ]
                  ],
                  [
                    'type' => 'col',
                    'class' => 'col-sm-12 col-md-6',
                    'children' => [
                      [
                          'type' => 'field',
                          'input' => 'image',
                          'identifier' => 'frontLogo',
                          'name' => 'frontLogo',
                          'label' => 'Logo',
                          'format' => 'medium'
                      ]

                    ] //end children col
                  ]
                ] //en children box

            ],//end box 3


            [
              'type' => 'box',
              'title' => 'Sidebar Settings',
              'identifier' => 'box_4',
              'children' => [
                  [
                    'type' => 'col',
                    'class' => 'col-sm-12 col-md-6',
                    'children' => [
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontSidebarColor',
                          'name' => 'frontSidebarColor',
                          'label' => 'Text color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontSidebarActiveColor',
                          'name' => 'frontSidebarActiveColor',
                          'label' => 'Active text color'
                      ]
                    ] //end children col
                  ],
                  [
                    'type' => 'col',
                    'class' => 'col-sm-12 col-md-6',
                    'children' => [
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontSidebarBackgroundColor',
                          'name' => 'frontSidebarBackgroundColor',
                          'label' => 'Background color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontSidebarActiveBackgroundColor',
                          'name' => 'frontSidebarActiveBackgroundColor',
                          'label' => 'Active Background color'
                      ]
                    ] //end children col
                  ],

                ]//en children box
            ],//end box 4


            [
              'type' => 'box',
              'title' => 'Body Settings',
              'identifier' => 'box_5',
              'children' => [
                  [
                    'type' => 'col',
                    'class' => 'col-md-12',
                    'children' => [
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontBodyTextColor',
                          'name' => 'frontBodyTextColor',
                          'label' => 'Text color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontBodyBackgroundColor',
                          'name' => 'frontBodyBackgroundColor',
                          'label' => 'Background color'
                      ]

                    ] //end children col
                  ],

                ]//en children box
            ],//end box 5

            [
              'type' => 'box',
              'title' => 'Footer Settings',
              'identifier' => 'box_6',
              'children' => [
                  [
                    'type' => 'col',
                    'class' => 'col-md-12',
                    'children' => [
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontFooterTextColor',
                          'name' => 'frontFooterTextColor',
                          'label' => 'Text color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontFooterHoverTextColor',
                          'name' => 'frontFooterHoverTextColor',
                          'label' => 'Text hover color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontFooterBackgroundColor',
                          'name' => 'frontFooterBackgroundColor',
                          'label' => 'Background color'
                      ]
                    ] //end children col
                  ],

                ]//en children box
            ],//end box 6

            [
              'type' => 'box',
              'title' => 'Elements Settings',
              'identifier' => 'box_7',
              'children' => [
                  [
                    'type' => 'col',
                    'class' => 'col-sm-12 col-md-6',
                    'children' => [
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontElementHeadColor',
                          'name' => 'frontElementHeadColor',
                          'label' => 'Header text color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontElementHeadBackground',
                          'name' => 'frontElementHeadBackground',
                          'label' => 'Header background color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontElementColor',
                          'name' => 'frontElementColor',
                          'label' => 'Body text color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontElementBackground',
                          'name' => 'frontElementBackground',
                          'label' => 'Body background color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontElementBorder',
                          'name' => 'frontElementBorder',
                          'label' => 'Body Separator color'
                      ]

                    ] //end children col
                  ],
                  [
                    'type' => 'col',
                    'class' => 'col-sm-12 col-md-6',
                    'children' => [
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontElementLinkColor',
                          'name' => 'frontElementLinkColor',
                          'label' => 'Link color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontElementLinkHoverColor',
                          'name' => 'frontElementLinkHoverColor',
                          'label' => 'Link hover color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontElementButtonColor',
                          'name' => 'frontElementButtonColor',
                          'label' => 'Button box color'
                      ],
                      [
                          'type' => 'field',
                          'input' => 'color',
                          'identifier' => 'frontElementButtonHoverColor',
                          'name' => 'frontElementButtonHoverColor',
                          'label' => 'Button box hover color'
                      ],

                    ] //end children col
                  ],

                ]//en children box
            ],//end box 7


            [
              'type' => 'box',
              'title' => 'Static Banner Settings',
              'identifier' => 'box_7',
              'children' => [
                  [
                    'type' => 'col',
                    'class' => 'col-sm-12 col-md-6',
                    'children' => [
                      [
                          'type' => 'field',
                          'input' => 'image',
                          'identifier' => 'bannerImage',
                          'name' => 'bannerImage',
                          'label' => 'Banner Image',
                          'format' => 'medium'
                      ]
                    ] //end children col
                  ],
                  [
                    'type' => 'col',
                    'class' => 'col-sm-12 col-md-6',
                    'children' => [
                      [
                          'type' => 'field',
                          'input' => 'richtext',
                          'identifier' => 'bannerText',
                          'name' => 'bannerText',
                          'label' => 'Banner Text'
                      ]
                    ] //end children col
                  ],

                ]//en children box
            ],//end box 7


      ]
    ]
];
