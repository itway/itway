<?php

namespace itway\Listeners;

use itway\Events\PollWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Itway\MailComposers\PollCreatedMailComposer;
use Itway\Models\Poll;
use Itway\Models\User;
use Illuminate\Support\Facades\App;

class PollWasCreatedListener
{
    /**
     * PollWasCreatedListener constructor.
     * @param PollCreatedMailComposer $mailer
     */

    public function __construct(PollCreatedMailComposer $mailer)
    {
        $this-> mailer = $mailer;
    }

    /**
     * @param PollWasCreated $event
     */

    public function handle(PollWasCreated $event)
    {
        $quiz = Poll::find($event->quiz->id);

        $title = $quiz->name;

        $link = App::getLocale().'/poll/'.$quiz->id;

        $user = User::find($event->user->id);

        $username = $user->name;

        $this->mailer->compose($user->email, $username, $title, $link)->send();

    }
}
