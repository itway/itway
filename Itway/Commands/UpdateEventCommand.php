<?php

namespace Itway\Commands;

use Illuminate\Support\Facades\Auth;
use itway\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use itway\Events\EventWasUpdated;

class UpdateEventCommand extends Command implements SelfHandling
{
    public $name;
    public $preamble;
    public $description;
    public $time;
    public $date;
    public $timezone;
    public $event_format;
    public $youtube_link;
    public $user_id;
    public $localed;
    public $tags_list;
    public $city;
    public $invite;


    public function __construct(
        $name, $preamble, $description, $time, $date, $timezone, $event_format, $youtube_link=null, $city=null, $invite=null, $user_id, $localed, $tags_list)
    {
        $this->name = $name;
        $this->preamble = $preamble;
        $this->description = $description;
        $this->time = $time;
        $this->date = $date;
        $this->timezone = $timezone;
        $this->event_format = $event_format;
        $this->youtube_link = $youtube_link;
        $this->user_id = $user_id;
        $this->localed = $localed;
        $this->tags_list = $tags_list;
        $this->city =$city;
        $this->invite = $invite;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle()

    {
        $event = Auth::user()->events()->create([
            'name' => $this->name,
            'preamble' => $this->preamble,
            'time' => $this->time,
            'date' => $this->date,
            'timezone' => $this->timezone,
            'event_format' => $this->event_format,
            'youtube_link' =>$this->youtube_link,
            'locale' => $this->localed,
            'city' => $this->city,
            'invite' => $this->invite

        ]);

        if(!empty($this->tags_list)) {

            $event->retag($this->tags_list);

        }
        $event->update();

        $event->description()->where('events_id', $event->id)->update(["description" => $this->description]);

        event(new EventWasUpdated($event, Auth::user()));

        return $event;
    }
}
