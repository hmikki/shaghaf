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

    'firebase' => [
        'api_key' => 'AIzaSyBankpts2W7NIjhNerkn3HDc0FDO8NGTj4',
        'auth_domain' => 'shaghaf-43a82.firebaseapp.com',
        'database_url' => 'database_url',
        'project_id' => 'shaghaf-43a82',
        'storage_bucket' => 'shaghaf-43a82.appspot.com',
        'messaging_sender_id' => '731253996105',
        'app_id' => '1:731253996105:web:d81fdcc51161535f47dd98',
        'measurement_id' => 'G-9SQ9PNLEQV',
    ],

];
