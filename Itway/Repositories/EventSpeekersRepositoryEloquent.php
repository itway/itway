<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\EventSpeekersRepository;
use Itway\Models\EventSpeekers;

/**
 * Class EventSpeekersRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class EventSpeekersRepositoryEloquent extends BaseRepository implements EventSpeekersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventSpeekers::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
