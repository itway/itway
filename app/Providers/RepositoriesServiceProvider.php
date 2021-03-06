<?php

namespace itway\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
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
        $repos = ['User', 'Post', 'EventSpeakers', 'Team', 'Event', 'Poll', 'OpenSourceIdea', 'Chat', 'TaskBoard'];
        foreach($repos as $repo) {
            $this->app->bind(
                "Itway\\Repositories\\{$repo}Repository",
                "Itway\\Repositories\\{$repo}RepositoryEloquent"
            );
        }

    }
}
