<?php

return [
    // Mely útvonalakra vonatkozzon a CORS (API + Sanctum cookie)
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Engedélyezett HTTP metódusok
    'allowed_methods' => ['*'],

    // Engedélyezett origin-ek fejlesztés alatt (Angular: http://localhost:4200)
    'allowed_origins' => ['http://localhost:4200'],

    'allowed_origins_patterns' => [],

    // Engedélyezett headerek
    'allowed_headers' => ['*'],

    // Exponált headerek
    'exposed_headers' => [],

    // Cache-elt preflight válasz másodpercekben
    'max_age' => 0,

    // Kell-e cookie / hitelesítés CORS-hoz (most nem szükséges)
    'supports_credentials' => false,
];
