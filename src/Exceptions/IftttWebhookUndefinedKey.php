<?php

namespace Arimolzer\IftttWebhook\Exceptions;

use Exception;

/**
 * Class IftttWebhookUndefinedKey
 * @package Arimolzer\IftttWebhook\Exceptions
 */
class IftttWebhookUndefinedKey extends Exception
{
    /** @var string $message */
    protected $message = 'A required IFTTT Webhook key has not been set.';
}
