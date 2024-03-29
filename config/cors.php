<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie', '/build/*'],

    'allowed_methods' => [
        'POST',
        'GET',
        'OPTIONS',
        'PUT',
        'PATCH',
        'DELETE',
    ],

    'allowed_origins' => ['www.short-science-articles.com', 'short-science-articles.com'],

    'allowed_origins_patterns' => ['*'],

    'allowed_headers' => [
        '*'
    ],

    'exposed_headers' => ['*'],

    'max_age' => 60 * 60 * 24,

    'supports_credentials' => false,

];
