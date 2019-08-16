<?php

return [
     // Determine if IFTTT webhooks should be enabled globally
    'enabled' => env('IFTTT_WEBHOOK_ENABLED', true),

    // The webhook key
    'key' => env('IFTTT_VOIP_WEBHOOK_KEY'),

    // List of events
    'events' => [

        // Default credentials for IftttWebhook notifications
        'default' => env('IFTTT_WEBHOOK_DEFAULT_EVENT'),

        // Optionally, publish this config file and add more events below.
    ]
];
