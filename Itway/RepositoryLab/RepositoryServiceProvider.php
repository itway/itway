<?php

namespace RepositoryLab\Repository;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package RepositoryLab\Repository\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/repository.php' => config_path('repository.php')
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/config/repository.php', 'repository'
        );

        $this->loadTranslationsFrom(__DIR__ . '/lang', 'repository');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands('RepositoryLab\Repository\Generators\Commands\RepositoryCommand');
        $this->commands('RepositoryLab\Repository\Generators\Commands\TransformerCommand');
        $this->commands('RepositoryLab\Repository\Generators\Commands\PresenterCommand');
        $this->commands('RepositoryLab\Repository\Generators\Commands\EntityCommand');
        $this->commands('RepositoryLab\Repository\Generators\Commands\cControllerCommand');
        $this->app->register('RepositoryLab\Repository\EventServiceProvider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}