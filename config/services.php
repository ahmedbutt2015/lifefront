<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    'stripe' => [
        'secret' => env('STRIPE_SECRET',''),
    ],

    'recaptcha' => [
        'key'=> env('RECAPTCHA_SITE_KEY'),
        'secret'=> env('RECAPTCHA_SECRET_KEY'),
    ],


    // Socialite API

    'github' => [
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => 'http://your-callback-url',
    ],

   'facebook' => [
        'client_id'     => env('FB_CLIENT_ID', 'error_no_client_ID'),
        'client_secret' => env('FB_CLIENT_SECRET', 'error_no_secret'),
        'redirect'      => env('APP_URL') . '/login/facebook/callback',
	],

   'linkedin' => [
        'client_id'     => env('GOOGLE_CLIENT_ID', 'error_no_client_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', 'error_no_secret'),
        'redirect'      => env('APP_URL') . '/login/linkedin/callback',
        ],

   'twitter' => [
        'client_id'       => env('GOOGLE_CLIENT_ID', 'error_no_client_ID'),
	'client_secret'   => env('GOOGLE_CLIENT_SECRET', 'error_no_secret'),
	'redirect'        => env('APP_URL') . '/login/twitter/callback',
	],

   'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID', 'error_no_client_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', 'error_no_secret'),
        'redirect'      => env('APP_URL') . '/login/google/callback',
	],
];
