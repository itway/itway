<?php

namespace Itway\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Itway\Models\Event;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\EventSpeakersRepository;
use Itway\Models\EventSpeakers;

/**
 * Class EventSpeekersRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class EventSpeakersRepositoryEloquent extends BaseRepository implements EventSpeakersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventSpeakers::class;
    }

    public function getModel()
    {
        $model = EventSpeakers::class;

        return new $model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getEventSpeaker($event_id)
    {

        try {
            $event = $event_id;

        } catch (ModelNotFoundException $e) {
            throwException($e);
        }

    }
}
