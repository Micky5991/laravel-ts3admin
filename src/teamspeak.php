<?php

return [

    /*
     * Determines if the connection should be established automatically
     */
    'connect' => env('TS_CONNECT', true),

    /*
     * Address of the host machine that hosts the TeamSpeak Server
     */
    'host' => env('TS_SERVER_HOST', '127.0.0.1'),

    /*
     * Port of the virtual server instance
     */
    'port' => env('TS_SERVER_PORT', 9987),

    /*
     * Maximum time the client is allowed to connect (in seconds)
     */
    'timeout' => env('TS_SERVER_TIMEOUT', 2),

    /*
     * Nickname that should be set when the client connected.
     */
    'nickname' => 'Laravel Webinterface',

    /*
     * Query specific credentials
     */
    'query' => [

        /*
         * Port of the query interface the the TeamSpeak server
         */
        'port' => env('TS_QUERY_PORT', 10011),

        /*
         * Username that will be used to authenticate with the server query.
         */
        'username' => env('TS_QUERY_USER', 'serveradmin'),

        /*
         * Password that will be used to authenticate with the server query.
         */
        'password' => env('TS_QUERY_PASSWORD')

    ]

];
