<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\QuizUserAnswerRepository;
use Itway\Models\QuizUserAnswer;

/**
 * Class QuizUserAnswerRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class QuizUserAnswerRepositoryEloquent extends BaseRepository implements QuizUserAnswerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return QuizUserAnswer::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
