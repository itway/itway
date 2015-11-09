<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\PaginationRepository;
use Itway\Models\Pagination;

/**
 * Class PaginationRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class PaginationRepositoryEloquent extends BaseRepository implements PaginationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pagination::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
