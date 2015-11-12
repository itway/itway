<?php

namespace Itway\Repositories;

use Itway\Uploader\ImageContract;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\OpenSourceIdeaRepository;
use Itway\Models\OpenSourceIdea;

/**
 * Class OpenSourceIdeaRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class OpenSourceIdeaRepositoryEloquent extends BaseRepository implements OpenSourceIdeaRepository, ImageContract
{
    use ImageTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OpenSourceIdea::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
