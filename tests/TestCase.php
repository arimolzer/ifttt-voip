<?php

namespace Arimolzer\IftttWebhook\Tests;

use Arimolzer\IftttWebhook\IftttWebhookServiceProvider;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;

/**
 * Class TestCase
 * @package Arimolzer\IftttWebhook\Tests
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [IftttWebhookServiceProvider::class];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'IftttWebhook' => 'IftttWebhook\Facade'
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Load the .env file
        $app->useEnvironmentPath(__DIR__.'/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);
        parent::getEnvironmentSetUp($app);
    }
}
