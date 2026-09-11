<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PayPing API Token
    |--------------------------------------------------------------------------
    |
    | You can get your API token from PayPing dashboard.
    |
    */
    'token' => env('PAYPING_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | Test Mode
    |--------------------------------------------------------------------------
    |
    | When set to true, the package will simulate API responses.
    |
    */
    'test_mode' => env('PAYPING_TEST_MODE', false),

    /*
    |--------------------------------------------------------------------------
    | Timeout
    |--------------------------------------------------------------------------
    |
    | The number of seconds to wait for a response from the API.
    |
    */
    'timeout' => 45,
];
