<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\EventsDescriptionRepository;
use Itway\Models\EventsDescription;

/**
 * Class EventsDescriptionRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class EventsDescriptionRepositoryEloquent extends BaseRepository implements EventsDescriptionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventsDescription::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
