<?php

return [
    /*
    | API secret from Dashboard → Tools → API Keys
    */
    'secret' => env('TARWEGE_API_SECRET', env('TARWEGE_API_KEY', '')),

    /*
    | Base URL must include /api (see dashboard/docs Redoc spec)
    */
    'base_url' => env('TARWEGE_BASE_URL', 'https://sms.tarwege.com/api'),

    'timeout' => (float) env('TARWEGE_TIMEOUT', 30),
];
