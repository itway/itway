<?php

namespace Itway\Components\Sidebar;

use Illuminate\Support\Collection;
use Itway\Models\Post;
use Itway\Models\JobHunt;
use Itway\Models\OpenSourceIdea;
use Itway\Models\Team;

trait SidebarTrait {

    protected $posts;
    protected $ideas;
    protected $jobs;
    protected $teams;

    /**
     *  SidebarTrait constructor.
     * @param Post $posts
     * @param OpenSourceIdea $ideas
     * @param JobHunt $jobs
     * @param Team $teams
     */

	public function __construct(
        Post $posts, OpenSourceIdea $ideas, JobHunt $jobs, Team $teams
    ) {
        $this->posts = $posts;
        $this->ideas = $ideas;
        $this->jobs = $jobs;
        $this->teams = $teams;
	}


    /**
     * @return int
     */
   public function fetch() {
        return 5;
   }
    public function getLastPosts() {

        return $this->posts->latest('published_at')->published()->localed()->take($this->fetch())->get();


	}

	public function getLastIdeas() {

	}

	public function getLastJobs() {

	}

	public function getLastTeams() {

	}


	public function formLastModelsCollection() {

        $collection = collect(["posts" => $this->getLastPosts()]);

        return $collection;
	}
}
