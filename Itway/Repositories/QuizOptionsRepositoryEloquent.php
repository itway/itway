<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\QuizOptionsRepository;
use Itway\Models\QuizOptions;

/**
 * Class QuizOptionsRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class QuizOptionsRepositoryEloquent extends BaseRepository implements QuizOptionsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return QuizOptions::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
