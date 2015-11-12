<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;
use Itway\Validation\Event\EventRequest;
/**
 * Interface EventRepository
 * @package namespace Itway\Repositories;
 */
interface EventRepository extends RepositoryInterface
{

	public function getModel();
    public function countUserEvents();
    public function createEvent(EventRequest $request, $image);
    public function todayEvents();
    public function getAll();
    public function getAllUsers();

}
