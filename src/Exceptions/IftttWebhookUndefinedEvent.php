<?php

namespace Arimolzer\IftttWebhook\Exceptions;

use Exception;

/**
 * Class IftttWebhookUndefinedEvent
 * @package Arimolzer\IftttWebhook\Exceptions
 */
class IftttWebhookUndefinedEvent extends Exception
{
    /** @var string $message */
    protected $message = 'A required IFTTT Webhook event has not been set.';
}
