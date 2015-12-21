<?php

namespace Itway\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Itway\Models\Event;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\EventSpeekersRepository;
use Itway\Models\EventSpeekers;

/**
 * Class EventSpeekersRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class EventSpeekersRepositoryEloquent extends BaseRepository implements EventSpeekersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventSpeekers::class;
    }

    public function getModel()
    {
        $model = EventSpeekers::class;

        return new $model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getEventSpeeker($event_id)
    {

        try {
            $event = $event_id;

        } catch (ModelNotFoundException $e) {
            throwException($e);
        }

    }
}
