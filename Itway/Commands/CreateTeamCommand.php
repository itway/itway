<?php

namespace Itway\Commands;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;
use itway\Events\TeamWasCreatedEvent;
use Itway\Models\Team;
use itway\Commands\Command;

class CreateTeamCommand extends Command implements SelfHandling
{

    public $name;
    public $owner;
    public $localed;
    public $tags_list;
    public $country;
    public $country_name;

    /**
     * CreateTeamCommand constructor.
     * @param $name
     * @param $owner
     * @param $localed
     * @param $tags_list
     * @param $country
     * @param $country_name
     */
    public function __construct(
        $name,
        $owner,
        $localed,
        $tags_list,
        $country,
        $country_name)
    {
        $this->name = $name;
        $this->owner = $owner;
        $this->localed = $localed;
        $this->tags_list = $tags_list;
        $this->country = $country;
        $this->country_name = $country_name;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle()
    {
        $team = new Team();
        $team->owner_id = $this->owner;
        $team->name = $this->name;
        $team->locale = $this->localed;
        $team->country = $this->country;
        $team->country_name = $this->country_name;
        $team->save();
        $team->tag($this->tags_list);

        event(new TeamWasCreatedEvent($team, Auth::user()));

        return $team;
    }
}
