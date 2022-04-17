<?php

return [


    /*
    |--------------------------------------------------------------------------
    | API Base URL - Open Weather Map
    |--------------------------------------------------------------------------
    |
    | This URL uses as a base URL for Open Weather Map API
    |
    */

    'api_baseurl' => env('OWM_BASE_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | API KEY - Open Weather Map
    |--------------------------------------------------------------------------
    |
    | This API key uses as a APP ID for Open Weather Map API
    |
    */

    'api_key' => env('OWM_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Cities with geocodes
    |--------------------------------------------------------------------------
    |
    | This dataset is uses as a list of cities and relevant geographic coordinates.
    |
    */

    'cities' => [
        [
            'slug' => 'colombo',
            'name' => 'Colombo',
            'lat' => '6.927079',
            'lon' => '79.861244'
        ],
        [
            'slug' => 'melbourne',
            'name' => 'Melbourne',
            'lat' => '-37.840935',
            'lon' => '144.946457'
        ],
    ],

];
