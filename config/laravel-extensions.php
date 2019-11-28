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

    'whitelist' => explode(',', env('LE_WHITELIST', '127.0.0.1' )),

    /*
    |--------------------------------------------------------------------------
    | Locales
    |--------------------------------------------------------------------------
    |
    | This option loads the available locales for your application previously
    | set in .env
    |
    */

    'locales' => env('LE_LOCALES', 'en'),

    'comingsoon' => 'package::path.to.view',



];
