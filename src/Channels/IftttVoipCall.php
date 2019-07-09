<?php

namespace Arimolzer\IftttVoip\Channels;

use Arimolzer\IftttVoip\Exceptions\IftttVoipWebhookException;
use Arimolzer\IftttVoip\IftttVoipFacade;
use Illuminate\Notifications\Notification;

/**
 * Class IftttVoipCall
 * @package Arimolzer\IftttVoip\Channels
 */
class IftttVoipCall
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
     * @throws \Arimolzer\IftttVoip\Exceptions\IftttVoipWebhookException
     */
    public function send($notifiable, Notification $notification) : bool
    {
        // Return immediately if IFTTT Voip is disabled in config
        if (!config('ifttt-voip.enabled')) {
            return false;
        }

        /** @var IftttVoipCall $message */
        $message = $notification->toIftttVoipCall($notifiable);

        try {
            return IftttVoipFacade::call($message->param1, $message->param2, $message->param3, $message->event, $message->key);
        } catch (\Exception $e) {
            throw new IftttVoipWebhookException();
        }
    }

    /**
     * @param string $key
     * @param string $event
     * @return IftttVoipCall
     */
    public function setConfig(string $key, string $event) : IftttVoipCall
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
    public function setParams($param1 = null, $param2 = null, $param3 = null) : IftttVoipCall
    {
        // Set the params - Currently limited to 3 by IFTTT
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->param3 = $param3;
        return $this;
    }
}
