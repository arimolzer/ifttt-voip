<?php

namespace Arimolzer\IftttWebhook\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class IftttVoipFacade
 * @package Arimolzer\IftttVoip
 */
class IftttWebhook extends Facade
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
