<?php

namespace Itway\Repositories;

use Itway\Uploader\ImageContract;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\ChatRepository;
use Itway\Models\Chat;

/**
 * Class ChatRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class ChatRepositoryEloquent extends BaseRepository implements ChatRepository, ImageContract
{
    use ImageTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chat::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
