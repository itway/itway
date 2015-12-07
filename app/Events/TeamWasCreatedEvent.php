<?php

namespace itway\Events;

use itway\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Itway\Models\Team;
use Itway\Models\User;

class TeamWasCreatedEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $team;

    public $user;

    /**
     * @param Team $team
     * @param User $user
     */
    public function __construct(Team $team, User $user)
    {

        $this->team = $team;
        $this->user = $user;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['team-created'];
    }
}
