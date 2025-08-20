<?php 

    return [
        'header' => env('API_KEY_HEADER', 'X-API-KEY'),

        'keys' => array_values(array_filter(array_map('trim', explode(',', (string) env('API_KEYS', ''))))),
    ];

?>