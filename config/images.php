<?php

return [
    'storage_directory' => 'public/medias',

    'display' => 'thumbnail',

    'formats' => [
        [
            'name' => 'thumbnail',
            'directory' => 'thumbnail',
            'ratio' => '1:1',
            'width' => 500,
            'height' => 500
        ],

        [
            'name' => 'banner',
            'directory' => 'banner',
            'ratio' => '2:1',
            'width' => 1000,
            'height' => 500
        ],
    ]

];
