<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\TeamsTrendsRepository;
use Itway\Models\TeamsTrends;

/**
 * Class TeamsTrendsRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class TeamsTrendsRepositoryEloquent extends BaseRepository implements TeamsTrendsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TeamsTrends::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
