<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\TeamRepository;
use Itway\Models\Team;

/**
 * Class TeamRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class TeamRepositoryEloquent extends BaseRepository implements TeamRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Team::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}