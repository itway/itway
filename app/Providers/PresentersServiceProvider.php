<?php

namespace itway\Providers;

use Illuminate\Support\ServiceProvider;

class PresentersServiceProvider extends ServiceProvider
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
        $models = ['User', 'Post', 'Team', 'Event', 'Quiz', 'OpenSourceIdea', 'Chat', 'TaskBoard'];
        foreach($models as $model) {
            $this->app->bind("Itway\\Presenters\\{$model}Presenter");
        }
    }
}
