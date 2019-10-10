<?php

namespace Arimolzer\IftttWebhook\Tests;

use Arimolzer\IftttWebhook\Exceptions\IftttWebhookException;
use Arimolzer\IftttWebhook\Facade\IftttWebhookFacade;

/**
 * Class FacadeTest
 * @package Arimolzer\IftttWebhook\Tests
 */
class FacadeTest extends TestCase
{
    public function testConfigValues(): void
    {
        // Assert config values are set
        $this->assertNotNull(config('ifttt-webhook'), "No config file has been loaded.");
        $this->assertNotNull(config('ifttt-webhook.key'), "No API Key has been configured.");
        $this->assertNotNull(config('ifttt-webhook.events.default'), "No default event has been configured.");
    }

    /** @test */
    public function testFacade(): void
    {
        /** Lets make a request to IFTTT and see if it succeeds. */
        $this->assertTrue(IftttWebhookFacade::call("One", "Two", "Three"));
    }

    /** @test */
    public function testException(): void
    {
        $this->expectException(IftttWebhookException::class);
        IftttWebhookFacade::call("One", "Two", "Three", null, null);
    }
}
