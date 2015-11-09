<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\TaskBoardRepository;
use Itway\Models\TaskBoard;

/**
 * Class TaskBoardRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class TaskBoardRepositoryEloquent extends BaseRepository implements TaskBoardRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TaskBoard::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
