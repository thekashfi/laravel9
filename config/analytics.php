<?php

return [

    /**
     * Analytics Dashboard.
     *
     * The prefix and middleware for the analytics dashboard.
     */
    'prefix' => 'admin/dashboard',

    'middleware' => [
        'web',
        'admin'
    ],

    /**
     * Exclude.
     *
     * The routes excluded from page view tracking.
     */
    'exclude' => [
        '/analytics',
        '/analytics/*',
    ],

    'session' => [
        'provider' => \AndreasElia\Analytics\RequestSessionProvider::class,
    ],

];
