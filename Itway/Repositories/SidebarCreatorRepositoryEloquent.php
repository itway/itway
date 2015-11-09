<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\SidebarCreatorRepository;
use Itway\Models\SidebarCreator;

/**
 * Class SidebarCreatorRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class SidebarCreatorRepositoryEloquent extends BaseRepository implements SidebarCreatorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SidebarCreator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
