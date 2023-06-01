<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    'tickets' => [
        'detail' => [
            'width' => 1024,
            'height' => 600,
            'canvas' => false
        ],
    ],

    'notes' => [
        'detail' => [
            'width' => 1024,
            'height' => 1024,
            'canvas' => false
        ],
    ],

];
