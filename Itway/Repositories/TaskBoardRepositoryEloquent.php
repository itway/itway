<?php

namespace Itway\Repositories;

use Itway\Models\TaskBoard;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use RepositoryLab\Repository\Eloquent\BaseRepository;

/**
 * Class TaskBoardRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class TaskBoardRepositoryEloquent extends BaseRepository implements TaskBoardRepository
{
    use ImageTrait;

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
