<?php

namespace itway\Events;

use itway\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Itway\Models\User;
use Itway\Models\Event as Ev;

class EventWasUpdated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $event;

    public $user;

    /**
     * EventWasCreatedEvent constructor.
     * @param \Itway\Models\Event $event
     * @param User $user
     */
    public function __construct(Ev $event, User $user)
    {

        $this->event = $event;
        $this->user = $user;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['event-updated'];
    }
}
