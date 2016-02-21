<?php

namespace itway\Listeners;

use itway\Events\EventWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Itway\Models\Event;
use Itway\MailComposers\EventCreatedMailComposer;
use App;
use Itway\Models\User;

class EventWasCreatedListener
{
    /**
     * @param EventCreatedMailComposer $mailer
     */
    public function __construct(EventCreatedMailComposer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     * @param EventWasCreatedEvent $eventE
     */
    public function handle(EventWasCreatedEvent $eventE)
    {
        $event = Event::find($eventE->event->id);

        $title = $event->name;

        $link = App::getLocale().'/events/event/'.$event->id;

        $user = User::find($eventE->user->id);

        $username = $user->name;

        $this->mailer->compose($user->email, $username, $title, $link)->send();
    }
}
