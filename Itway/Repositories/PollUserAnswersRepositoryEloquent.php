<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\PollUserAnswersRepository;
use Itway\Models\PollUserAnswers;

/**
 * Class PollUserAnswersRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class PollUserAnswersRepositoryEloquent extends BaseRepository implements PollUserAnswersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PollUserAnswers::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
