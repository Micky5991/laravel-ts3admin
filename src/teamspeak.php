<?php

return [

    'host' => env('TS_SERVER_HOST', '127.0.0.1'),

    'port' => env('TS_SERVER_PORT', 9987),

    'timeout' => env('TS_SERVER_TIMEOUT', 2),

    'nickname' => 'Laravel Webinterface',

    'query' => [

        'port' => env('TS_QUERY_PORT', 10011),

        'username' => env('TS_QUERY_USER', 'serveradmin'),

        'password' => env('TS_QUERY_PASSWORD')

    ]

];
