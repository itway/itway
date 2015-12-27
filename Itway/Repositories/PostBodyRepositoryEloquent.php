<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\PostBodyRepository;
use Itway\Models\PostBody;

/**
 * Class PostBodyRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class PostBodyRepositoryEloquent extends BaseRepository implements PostBodyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PostBody::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
