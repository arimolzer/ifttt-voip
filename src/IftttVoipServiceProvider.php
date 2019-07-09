<?php

namespace Arimolzer\IftttVoip;

use Arimolzer\IftttVoip\Commands\TestIftttVoipCall;
use Illuminate\Support\ServiceProvider;

/**
 * Class IftttVoipServiceProvider
 * @package Arimolzer\IftttVoip
 */
class IftttVoipServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('ifttt-voip.php'),
            ], 'config');

            // Registering package commands.
            $this->commands([
                TestIftttVoipCall::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'ifttt-voip');

        // Register the main class to use with the facade
        $this->app->singleton('IftttVoip', function () {
            return new IftttVoip;
        });
    }
}
