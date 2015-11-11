<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\EventUsersRepository;
use Itway\Models\EventUsers;

/**
 * Class EventUsersRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class EventUsersRepositoryEloquent extends BaseRepository implements EventUsersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventUsers::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
