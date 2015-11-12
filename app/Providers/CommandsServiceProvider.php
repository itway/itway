<?php

namespace itway\Providers;

use Illuminate\Support\ServiceProvider;

class CommandsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $commands = ['Post', 'Quiz', 'User', 'Event', 'OpenSourceIdea', 'Chat', 'TaskBoard'];
        foreach($commands as $command) {
            $this->app->bind("Itway\\Commands\\Create{$command}Command");
            $this->app->bind("Itway\\Commands\\Update{$command}Command");
        }
    }
}
