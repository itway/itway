<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\CounterRepository;
use Itway\Models\Counter;

/**
 * Class CounterRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class CounterRepositoryEloquent extends BaseRepository implements CounterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Counter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
