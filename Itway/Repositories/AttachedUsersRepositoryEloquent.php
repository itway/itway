<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\AttachedUsersRepository;
use Itway\Models\AttachedUsers;

/**
 * Class AttachedUsersRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class AttachedUsersRepositoryEloquent extends BaseRepository implements AttachedUsersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AttachedUsers::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
