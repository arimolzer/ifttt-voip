<?php

namespace Arimolzer\IftttVoip;

use Illuminate\Support\Facades\Facade;

/**
 * Class IftttVoipFacade
 * @package Arimolzer\IftttVoip
 */
class IftttVoipFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'IftttVoip';
    }
}
