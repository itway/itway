<?php

namespace itway\Events;

use itway\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Itway\Models\Poll;
use Itway\Models\User;

class PollWasCreated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $poll;

    public $user;

    /**
     * @param Quiz $quz
     * @param User $user
     */
    public function __construct(Poll $poll, User $user)
    {

        $this->poll = $poll;
        $this->user = $user;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['poll-created'];
    }
}
