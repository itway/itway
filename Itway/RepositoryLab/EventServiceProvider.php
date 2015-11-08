<?php

namespace RepositoryLab\Repository;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'RepositoryLab\Repository\Events\RepositoryEntityCreated' => [
            'RepositoryLab\Repository\Listeners\CleanCacheRepository'
        ],
        'RepositoryLab\Repository\Events\RepositoryEntityUpdated' => [
            'RepositoryLab\Repository\Listeners\CleanCacheRepository'
        ],
        'RepositoryLab\Repository\Events\RepositoryEntityDeleted' => [
            'RepositoryLab\Repository\Listeners\CleanCacheRepository'
        ]
    ];
}