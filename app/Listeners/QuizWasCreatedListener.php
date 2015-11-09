<?php

namespace itway\Listeners;

use itway\Events\QuizWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Itway\MailComposers\QuizCreatedMailComposer;
use Itway\Models\Quiz;
use Itway\Models\User;
use Illuminate\Support\Facades\App;

class QuizWasCreatedListener
{
    /**
     * QuizWasCreatedListener constructor.
     * @param QuizCreatedMailComposer $mailer
     */

    public function __construct(QuizCreatedMailComposer $mailer)
    {
        $this-> mailer = $mailer;
    }

    /**
     * @param QuizWasCreated $event
     */

    public function handle(QuizWasCreated $event)
    {
        $quiz = Quiz::find($event->quiz->id);

        $title = $quiz->name;

        $link = App::getLocale().'/quiz/'.$quiz->id;

        $user = User::find($event->user->id);

        $username = $user->name;

        $this->mailer->compose($user->email, $username, $title, $link)->send();

    }
}
