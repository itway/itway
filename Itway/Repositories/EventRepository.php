<?php

namespace Itway\Repositories;

use Itway\Validation\Event\EventRequest;
use Itway\Validation\Event\UpdateEventRequest;
use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface EventRepository
 * @package namespace Itway\Repositories;
 */
interface EventRepository extends RepositoryInterface
{

    /**
     * @return mixed
     */
    public function getModel();

    /**
     * @return mixed
     */
    public function countUserEvents();

    /**
     * @param EventRequest $request
     * @param $image
     * @return mixed
     */
    public function createEvent(EventRequest $request, $image);


    /**
     * @param UpdateEventRequest $request
     * @param $image
     * @return mixed
     */
    public function updateEvent(UpdateEventRequest $request, $image);

    /**
     * @return mixed
     */
    public function todayEvents();

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getAllUsers();

    /**
     * @param $id
     * @return mixed
     */
    public function banORunBan($id);

    /**
     * @param $event
     * @param $speakers
     * @return mixed
     */
    public function bindSpeakers($event, $speakers);

    /**
     * @param $event
     * @return mixed
     */
    public function unBindSpeakers($event);

    /**
     * @param $event
     * @param $speakers
     * @return mixed
     */
    public function updateSpeakers($event, $speakers);

    /**
     * @param $event
     * @param $subscriberID
     * @return mixed
     */
    public function bindSubscriber($event, $subscriberID);

    /**
     * @param $event
     * @param $subscriberID
     * @return mixed
     */
    public function unBindSubscriber($event, $subscriberID);

    /**
     * @param $eventID
     * @return mixed
     */
    public function getSpeakers($eventID);

}
