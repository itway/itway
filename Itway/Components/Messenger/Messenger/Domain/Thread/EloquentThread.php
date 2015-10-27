<?php namespace Itway\Components\Messenger\Domain\Thread;

use Itway\Components\Messenger\Repositories\EloquentRepository;
use Itway\Components\Messenger\Repositories\Repository;

class EloquentThread extends EloquentRepository implements Repository, ThreadRepository
{
    /**
     * Persists a given thread
     *
     * @param Thread $thread
     * @return Thread
     */
    public function save(Thread $thread)
    {
        // @todo: Implement save() method.
    }

    /**
     * Returns all threads for a given user
     *
     * @param $userId
     * @return Thread
     */
    public function getForUser($userId)
    {
        // @todo: Implement getForUser() method.
    }
}
