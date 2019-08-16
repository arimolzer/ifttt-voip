<?php

namespace Arimolzer\IftttWebhook;

use Illuminate\Support\ServiceProvider;

/**
 * Class IftttWebhookServiceProvider
 * @package Arimolzer\IftttWebhook
 */
class IftttWebhookServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('ifttt-webhook.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'ifttt-webhook');

        // Register the main class to use with the facade
        $this->app->singleton('IftttWebhook', function () {
            return new IftttWebhookService;
        });
    }
}
