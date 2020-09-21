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
        'client_id'     => '657619738146445',
        'client_secret' => 'c4801383e3a4d5aec6543d4a350dfdb0',
        'redirect'      => 'http://life.soft-wizards.com/login/facebook/callback',
    ],

    'google' => [
        'client_id'     => '277548075191-0mfrsoeud7hcvlgcoqar10g8lm983cfo.apps.googleusercontent.com',
        'client_secret' => '5-06TnG7MrTMew16XkNaArFC',
        'redirect'      => 'http://life.soft-wizards.com/login/google/callback',
    ],

];
