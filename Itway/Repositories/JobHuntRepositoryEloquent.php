<?php

namespace Itway\Repositories;

use Itway\Models\JobHunt;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use RepositoryLab\Repository\Eloquent\BaseRepository;

/**
 * Class JobHuntRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class JobHuntRepositoryEloquent extends BaseRepository implements JobHuntRepository
{
    use ImageTrait;

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
