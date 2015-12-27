<?php

namespace Itway\Commands;

use itway\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Auth;
use itway\Events\PostWasCreatedEvent;

class CreatePostCommand extends Command implements SelfHandling {


    public $title;
    public $preamble;
    public $body;
    public $tags_list;
    public $published_at;
    public $localed;
    public $youtubelink;
    public $githublink;

    /**
     * @param $title
     * @param $preamble
     * @param $body
     * @param $tags_list
     * @param $published_at
     * @param $localed
     */
    public function __construct(
            $title,
            $preamble,
            $body,
            $tags_list,
            $published_at,
            $localed,
            $youtubelink = null,
            $githublink = null)
	{
            $this->title = $title;
            $this->preamble = $preamble;
            $this->body = $body;
            $this->tags_list = $tags_list;
            $this->published_at = $published_at;
            $this->localed = $localed;
            $this->youtubelink = $youtubelink;
            $this->githublink = $githublink;
	}


    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle()

    {
        $post =  Auth::user()->posts()->create([
            'title' => $this->title,
            'preamble' => $this->preamble,
            'tags_list' => $this->tags_list,
            'locale' => $this->localed,
            'youtube_link'=> $this->youtubelink,
            'github_link' => $this->githublink,
            'published_at' => $this->published_at
        ]);

        $post->tag($this->tags_list);

        $post->save();

        $post->body()->create(["body" => $this->body]);

        event(new PostWasCreatedEvent($post, Auth::user()));

        return $post;
    }
}
