<?php

namespace Arimolzer\IftttWebhook\Channels;

use Illuminate\Notifications\Notification;

/**
 * Class IftttWebhookChannel
 * @package Arimolzer\IftttWebhook\Channels
 */
class IftttWebhookChannel
{
    /** @var string $key */
    protected $key;

    /** @var string $event */
    protected $event;

    /** @var string $param1 */
    protected $param1;

    /** @var string $param2 */
    protected $param2;

    /** @var string $param3 */
    protected $param3;

    /**
     * @param $notifiable
     * @param Notification $notification
     * @return bool
     */
    public function send($notifiable, Notification $notification) : bool
    {
        // Return immediately if IFTTT Voip is disabled in config
        if (!config('ifttt-webhook.enabled')) {
            return false;
        }

        /** @var IftttWebhookChannel $message */
        $message = $notification->toIftttWebhook($notifiable);

        return IftttWebhook::call($message->param1, $message->param2, $message->param3, $message->event, $message->key);
    }

    /**
     * @param string $key
     * @param string $event
     * @return IftttWebhookChannel $this
     */
    public function setConfig(string $key, string $event) : IftttWebhookChannel
    {
        $this->key = $key;
        $this->event = $event;
        return $this;
    }

    /**
     * @param null $param1
     * @param null $param2
     * @param null $param3
     * @return $this
     */
    public function setParams($param1 = null, $param2 = null, $param3 = null) : IftttWebhookChannel
    {
        // Set the params - Currently limited to 3 by IFTTT.
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->param3 = $param3;
        return $this;
    }
}
