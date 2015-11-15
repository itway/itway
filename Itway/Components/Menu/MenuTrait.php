<?php

namespace Itway\Components\Menu;

use Illuminate\Support\Collection;
use Itway\Models\Post;
use Itway\Models\JobHunt;
use Itway\Models\OpenSourceIdea;
use Itway\Models\Quiz;
use Itway\Models\Team;

trait MenuTrait {

    protected $posts;
    protected $quizzes;
    protected $ideas;
    protected $jobs;
    protected $teams;

    /**
     *  SidebarTrait constructor.
     * @param Post $posts
     * @param OpenSourceIdea $ideas
     * @param JobHunt $jobs
     * @param Quiz $quizzes
     * @param Team $teams
     */

	public function __construct(
        Post $posts, OpenSourceIdea $ideas, JobHunt $jobs, Quiz $quizzes, Team $teams
    ) {
        $this->posts = $posts;
        $this->quizzes = $quizzes;
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

	public function getLastQuizzes() {

        return $this->quizzes->latest('published_at')->localed()->take($this->fetch())->get();


	}

	public function getLastIdeas() {

	}

	public function getLastJobs() {

	}

	public function getLastTeams() {

	}


	public function formLastModelsCollection() {

        $collection = collect(["posts" => $this->getLastPosts(), "quizzes" => $this->getLastQuizzes()]);

        return $collection;
	}
}
