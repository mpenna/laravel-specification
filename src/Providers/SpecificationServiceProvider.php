<?php

namespace Chalcedonyt\Specification\Providers;

use Chalcedonyt\Specification\Commands\SpecificationGeneratorCommand;
use Illuminate\Support\ServiceProvider;

class SpecificationServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $source_config = __DIR__ . '/../config/specification.php';
        $this->publishes([$source_config => config_path('specification.php')], 'config');
        $this->loadViewsFrom(__DIR__ . '/../views', 'specification');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $source_config = __DIR__ . '/../config/specification.php';
        $this->mergeConfigFrom($source_config, 'specification');

        // register the generator command
        if ($this->app->runningInConsole()) {
            $this->commands([
                SpecificationGeneratorCommand::class,
            ]);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['specification', 'command.specification.generate'];
    }
}
