<?php

use Illuminate\Support\Carbon;

return [
    'format' => match (env('DATETIME_FORMAT', 'ATOM')) {
        'ATOM' => Carbon::ATOM,

        // handles values like Y-m-d\TH:i:sP
        default => env('DATETIME_FORMAT'),
    },
];
