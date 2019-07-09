<?php

namespace Arimolzer\IftttVoip\Exceptions;

use Exception;

/**
 * Class IftttVoipUndefinedEvent
 * @package Arimolzer\IftttVoip\Exceptions
 */
class IftttVoipUndefinedEvent extends Exception
{
    /** @var string $message */
    protected $message = 'A required IFTTT Webhook event has not been set.';
}
