<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

	'google' => [
		'client_id' => '506697099775-bhgcmdckef3mgb570cu3mlb8ltkrjr9b.apps.googleusercontent.com',
		'client_secret' => 'aPwXGQHYkYG9M-N2VYmtXe7k',
		'redirect' => 'https://www.cryptodales.com/socialite/google/callback'
	],
	'facebook' => [
		'client_id' => '593617281137591',
		'client_secret' => '66a24cc9fec938f6f0486295f39cbc72',
		'redirect' => 'https://www.cryptodales.com/socialite/facebook/callback'
	]
];
