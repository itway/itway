<?php

namespace itway\Events;

use itway\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use itway\Quiz;
use itway\User;

class QuizWasCreated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $quiz;

    public $user;

    /**
     * @param Post $post
     * @param User $user
     */
    public function __construct(Quiz $quz, User $user)
    {

        $this->quiz = $quz;
        $this->user = $user;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['quiz-created'];
    }
}
