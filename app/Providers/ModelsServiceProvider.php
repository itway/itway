<?php

namespace itway\Providers;

use Illuminate\Support\ServiceProvider;

class ModelsServiceProvider extends ServiceProvider
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
        $models = [
            'User',
            'Post',
            'Team',
            'Event',
            'Quiz',
            'IdeaShare',
            'Chat',
            'TaskBoard',
            'Counter',
            'Like',
            'LikeCounter',
            'Pagination',
            'Permission',
            'Role',
            'QuizOptions',
            'SideBarCreator',
            'UserCounter'
        ];
        foreach($models as $model) {
            $this->app->bind("Itway\\Models\\{$model}");
        }
    }
}
