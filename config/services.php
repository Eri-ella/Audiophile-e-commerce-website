<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides a de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_API_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    
    'fedapay' => [
        'secret'     => env('FEDAPAY_SECRET_KEY'),
        'public'     => env('FEDAPAY_PUBLIC_KEY'),
        'env'        => env('FEDAPAY_ENV', 'sandbox'),
        'usd_to_xof' => env('USD_TO_XOF', 600),   
    ],

    'kkiapay' => [
        'public_key'  => env('KKIAPAY_PUBLIC_KEY'),
        'private_key' => env('KKIAPAY_PRIVATE_KEY'),
        'secret'      => env('KKIAPAY_SECRET'),
        'sandbox'     => env('KKIAPAY_SANDBOX', true),
    ],

    'feexpay' => [
        'shop_id'      => env('FEEXPAY_SHOP_ID'),
        'token'        => env('FEEXPAY_TOKEN'),
        'callback_url' => env('FEEXPAY_CALLBACK_URL'),
        'mode'         => env('FEEXPAY_MODE', 'SANDBOX'),
    ],    

];