<?php

namespace Arimolzer\IftttVoip;

use Arimolzer\IftttVoip\Exceptions\IftttVoipUndefinedKey;
use Arimolzer\IftttVoip\Exceptions\IftttVoipWebhookException;
use GuzzleHttp\Client;

/**
 * Class IftttVoip
 * @package Arimolzer\IftttVoip
 */
class IftttVoip
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
     * IftttVoipCall constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->event = config('ifttt-voip.credentials.default.event');
        $this->key = config('ifttt-voip.credentials.default.key');
    }

    /**
     * @param null $param1
     * @param null $param2
     * @param null $param3
     * @param null $event
     * @param null $key
     * @return bool
     * @throws IftttVoipUndefinedKey
     * @throws IftttVoipWebhookException
     */
    public function call($param1 = null, $param2 = null, $param3 = null, $event = null, $key = null) : bool
    {
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
            throw new IftttVoipWebhookException();
        } elseif (!$this->key) {
            throw new IftttVoipUndefinedKey();
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


            dd($e);

            throw new IftttVoipWebhookException();
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
