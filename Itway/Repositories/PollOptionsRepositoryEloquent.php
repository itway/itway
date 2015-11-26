<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\PollOptionsRepository;
use Itway\Models\PollOptions;

/**
 * Class PollOptionsRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class PollOptionsRepositoryEloquent extends BaseRepository implements PollOptionsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PollOptions::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
