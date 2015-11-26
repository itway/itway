<?php

namespace Itway\Commands;

use itway\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Auth;
use itway\Events\PollWasCreated;
use Itway\Models\Poll;

class CreatePollCommand extends Command implements SelfHandling
{
    public $name;
    public $hint;
    public $tags_list;
    public $published_at;
    public $localed;

    /**
     * @param $name
     * @param $hint
     * @param $tags_list
     * @param $published_at
     * @param $localed
     */
    public function __construct(
        $name,
        $hint,
        $tags_list,
        $published_at,
        $localed)
    {
        $this->title = $name;
        $this->hint = $hint ? $hint : null;
        $this->tags_list = $tags_list;
        $this->published_at = $published_at;
        $this->localed = $localed;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle()

    {
        $poll =  Auth::user()->poll()->create([
            'name' => $this->title,
            'hint' => $this->hint,
            'tags_list' => $this->tags_list,
            'locale' => $this->localed,
            'published_at' => $this->published_at

        ]);

        if(!empty($this->tags_list)) {

            $poll->tag($this->tags_list);

        }

        $poll->save();

        event(new PollWasCreated($poll, Auth::user()));

        return $poll;
    }
}
