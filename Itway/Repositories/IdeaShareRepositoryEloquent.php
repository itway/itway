<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\IdeaShareRepository;
use Itway\Models\IdeaShare;

/**
 * Class IdeaShareRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class IdeaShareRepositoryEloquent extends BaseRepository implements IdeaShareRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return IdeaShare::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
