<?php

namespace Itway\Commands;

use itway\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Auth;
use itway\Events\EventWasCreatedEvent;

class CreateEventCommand extends Command implements SelfHandling
{
    public $name;
    public $description;
    public $time;
    public $date;
    public $event_format;
    public $user_id;
    public $organizer;
    public $place;
    public $max_people_number;
    public $organizer_link;
    public $published_at;
    public $localed;

    public function __construct(
           $name, $description, $time, $date, $event_format, $user_id, $organizer, $place, $max_people_number, $organizer_link, $published_at, $localed)
    {
            $this->name = $name;
            $this->description = $description;
            $this->time = $time;
            $this->date = $date;
            $this->event_format = $event_format;
            $this->user_id = $user_id;
            $this->organizer = $organizer;
            $this->place = $place;
            $this->max_people_number = $max_people_number;
            $this->published_at = $published_at;
            $this->organizer_link = $organizer_link;
            $this->localed = $localed;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle()

    {
        $event =  Auth::user()->event()->create([
            'name' => $this->name,
            'description' => $this->description,
            'time' => $this->time,
            'date' => $this->date,
            'format' => $this->event_format,
            'organizer' => $this->organizer,
            'place' => $this->place,
            'max_people_number' => $this->max_people_number,
            'organizer_link' => $this->organizer_link,
            'locale' => $this->localed,
            'published_at' => $this->published_at

        ]);

        // $event->tag($this->tags_list);

        $event->save();

        event(new EventWasCreatedEvent($event, Auth::user()));

        return $event;
    }
}
