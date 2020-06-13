<?php

return [
    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',
    'locale' => env('APP_LOCALE', 'en'),
    'timezone' => 'PRC',

    'user_session_token_key' => 'moon_token',
    'user_session_cache_key_prefix' => 'user_session:',
    'view_list_per_page' => 20,
];