<?php

namespace itway\Events;

use itway\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Itway\Models\User;


class UserEnteredChatEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $user;

    /**
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['chat-connected'];
    }
}
