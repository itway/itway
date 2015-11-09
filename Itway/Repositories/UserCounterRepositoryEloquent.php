<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\UserCounterRepository;
use Itway\Models\UserCounter;

/**
 * Class UserCounterRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class UserCounterRepositoryEloquent extends BaseRepository implements UserCounterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserCounter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
