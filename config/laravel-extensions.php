<?php

return [

    /*
    |--------------------------------------------------------------------------
    | IP Whitelist
    |--------------------------------------------------------------------------
    |
    | This option allows you to specify the ip addresses to be whitelisted
    | when using the ipRestrict Laravel Middleware.
    |
    */

    'whitelist' => explode(',', env('LE_WHITELIST')),

];
