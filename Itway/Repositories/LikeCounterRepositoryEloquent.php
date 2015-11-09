<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\LikeCounterRepository;
use Itway\Models\LikeCounter;

/**
 * Class LikeCounterRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class LikeCounterRepositoryEloquent extends BaseRepository implements LikeCounterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LikeCounter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
