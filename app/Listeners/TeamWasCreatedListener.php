<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/30/2015
 * Time: 1:49 AM
 */

namespace itway\Listeners;

use itway\Events\TeamWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Itway\MailComposers\TeamWasCreatedMailComposer;
use Itway\Models\Team;
use App;
use Itway\Models\User;


class TeamWasCreatedListener
{

    /**
     * @param TeamWasCreatedMailComposer $mailer
     */
    public function __construct(TeamWasCreatedMailComposer $mailer)
    {
        $this-> mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  TeamWasCreatedEvent  $event
     * @return void
     */
    public function handle(TeamWasCreatedEvent $event)
    {
        $team = Team::find($event->team->id);

        $title = $team->title;

        $link = App::getLocale().'/team/'.$team->id;

        $user = User::find($event->user->id);

        $username = $user->name;

        $this->mailer->compose($user->email, $username, $title, $link)->send();

    }

}