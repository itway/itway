<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\LikeRepository;
use Itway\Models\Like;

/**
 * Class LikeRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class LikeRepositoryEloquent extends BaseRepository implements LikeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Like::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
