<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default MAL
    |--------------------------------------------------------------------------
    |
    | This option controls the default mal credentials that is used to send any
    | API request sent by your application.
    |
    */
    'client' => [
        'id' => env('MAL_CLIENT_ID'),
        'secret' => env('MAL_CLIENT_SECRET'),
        'authorization' => env('MAL_AUTHORIZATION_URI'),
    ],
];
