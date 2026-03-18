<?php

return [
    'name' => env('APP_NAME', 'DBtecno Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => 'Europe/Istanbul',
    'locale' => env('APP_LOCALE', 'tr'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'tr'),
    'faker_locale' => env('APP_FAKER_LOCALE', 'tr_TR'),
    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),
    'providers' => [
        App\Providers\AppServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ],
];
