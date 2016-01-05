<?php

namespace Itway\Repositories;

use Itway\Contracts\Bannable\Bannable;
use Itway\Models\JobHunt;
use Itway\Traits\Banable;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use RepositoryLab\Repository\Eloquent\BaseRepository;

/**
 * Class JobHuntRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class JobHuntRepositoryEloquent extends BaseRepository implements JobHuntRepository, Bannable
{
    use Banable;
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
