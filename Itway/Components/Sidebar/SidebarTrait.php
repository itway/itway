<?php

namespace Itway\Components\Sidebar;

use Illuminate\Support\Collection;
use itway\Post;
use itway\Job;
use itway\Idea;
use itway\Quiz;
use itway\Team;

trait SidebarTrait {

    protected $posts;
    protected $quizzes;
    protected $ideas;
    protected $jobs;
    protected $teams;

    /**
     * SidebarTrait constructor.
     * @param Post $posts
     * @param Idea $ideas
     * @param Job $jobs
     * @param Quiz $quizzes
     * @param Team $teams
     */
	public function __construct(
        Post $posts, Idea $ideas, Job $jobs, Quiz $quizzes, Team $teams
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
