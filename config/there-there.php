<?php

use Spatie\ThereThere\Http\Middleware\IsValidThereThereRequest;

// config for Spatie/ThereThere
return [
    /*
     * The secret used to verify incoming requests from There There.
     * You can find this in your There There workspace settings.
     */
    'secret' => env('THERE_THERE_SECRET'),

    /*
     * The URL where There There will send requests to.
     * Set to null to disable automatic route registration.
     */
    'url' => '/there-there',

    /*
     * The middleware that will be applied to the There There route.
     */
    'middleware' => [
        IsValidThereThereRequest::class,
        'api',
    ],
];
