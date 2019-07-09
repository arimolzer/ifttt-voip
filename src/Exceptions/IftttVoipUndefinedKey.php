<?php

namespace Arimolzer\IftttVoip\Exceptions;

use Exception;

/**
 * Class IftttVoipUndefinedKey
 * @package Arimolzer\IftttVoip\Exceptions
 */
class IftttVoipUndefinedKey extends Exception
{
    /** @var string $message */
    protected $message = 'A required IFTTT Webhook key has not been set.';
}
