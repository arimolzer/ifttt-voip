<?php

namespace Arimolzer\IftttWebhook;

use Arimolzer\IftttWebhook\Exceptions\IftttWebhookUndefinedEvent;
use Arimolzer\IftttWebhook\Exceptions\IftttWebhookUndefinedKey;
use Arimolzer\IftttWebhook\Exceptions\IftttWebhookException;
use GuzzleHttp\Client;

/**
 * Class IftttWebhook
 * @package Arimolzer\IftttWebhook
 */
class IftttWebhookService
{
    /** @var string */
    const IFTTT_WEBHOOK_URL = "https://maker.ifttt.com/trigger/%s/with/key/%s";

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

    /** @var Client */
    protected $client;

    /**
     * IftttWebhookService constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->event = config('ifttt-webhook.key');
        $this->key = config('ifttt-webhook.events.default');
    }

    /**
     * @param string|null $param1
     * @param string|null $param2
     * @param string|null $param3
     * @param string|null $event
     * @param string|null $key
     * @return bool
     * @throws IftttWebhookUndefinedEvent
     * @throws IftttWebhookUndefinedKey
     * @throws IftttWebhookException
     */
    public function call(
        string $param1 = null,
        string $param2 = null,
        string $param3 = null,
        string $event = null,
        string $key = null
    ) : bool {
        // Set the params to send to the IFTTT endpoint.
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->param3 = $param3;

        // Set the event and key to the provided values or default
        // to the config value set inside the class constructor.
        $this->event = $event ?? $this->event;
        $this->key = $key ?? $this->key;

        // Throw exceptions if no key or event values are configured or provided.
        if (!$this->event) {
            throw new IftttWebhookUndefinedEvent();
        } elseif (!$this->key) {
            throw new IftttWebhookUndefinedKey();
        }

        try {
            // Trigger IFTTT workflow with
            $response = $this->client->request('POST', $this->getUrl($this->event, $this->key), [
                'json' => [
                    'value1' => $this->param1,
                    'value2' => $this->param2,
                    'value3' => $this->param3,
                ],
            ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            throw new IftttWebhookException();
        }

        // If the response code is inside the HTTP status code success range return true, else false.
        return $response->getStatusCode() > 200 && $response->getStatusCode() < 300;
    }

    /**
     * Build the URL to post to.
     *
     * @param string $event
     * @param string $key
     * @return string
     */
    protected function getUrl(string $event, string $key) : string
    {
        return sprintf(self::IFTTT_WEBHOOK_URL, $event, $key);
    }
}
