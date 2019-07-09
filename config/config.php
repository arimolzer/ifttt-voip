<?php

return [
     // Determine if IFTTT VOIP messages should be enabled globally
    'enabled' => env('IFTTT_VOIP_ENABLED', true),

     // Default credentials for IFTTTVoipCall notifications
    'credentials' => [
        'default' => [
            'key' => env('IFTTT_VOIP_DEFAULT_WEBHOOK_KEY'),
            'event' => env('IFTTT_VOIP_DEFAULT_WEBHOOK_EVENT'),
        ]
    ]
];
