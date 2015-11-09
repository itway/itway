<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\JobHuntRepository;
use Itway\Models\JobHunt;

/**
 * Class JobHuntRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class JobHuntRepositoryEloquent extends BaseRepository implements JobHuntRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return JobHunt::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
