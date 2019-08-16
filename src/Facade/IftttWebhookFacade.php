<?php

namespace Arimolzer\IftttWebhook\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class IftttWebhook
 * @package Arimolzer\IftttWebhook
 */
class IftttWebhookFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'IftttWebhook';
    }
}
