<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\PictureRepository;
use Itway\Models\Picture;

use Itway\Contracts\Bannable\Bannable;
use Itway\Traits\Banable;
/**
 * Class PictureRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class PictureRepositoryEloquent extends BaseRepository implements PictureRepository, Bannable
{
    use Banable;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Picture::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
