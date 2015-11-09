<?php

namespace Itway\Commands;

use itway\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Auth;
use itway\Events\QuizWasCreated;
use Itway\Models\Quiz;

class CreateQuizCommand extends Command implements SelfHandling
{
    public $name;
    public $questions;
    public $tags_list;
    public $published_at;
    public $localed;

    /**
     * CreateQuizCommand constructor.
     * @param $name
     * @param $question
     * @param $tags_list
     * @param $published_at
     * @param $localed
     */
    public function __construct(
        $name,
        $question,
        $tags_list,
        $published_at,
        $localed)
    {
        $this->title = $name;
        $this->question = $question ? $question: null;
        $this->tags_list = $tags_list;
        $this->published_at = $published_at;
        $this->localed = $localed;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle()

    {
        $quiz =  Auth::user()->quizzes()->create([
            'name' => $this->title,
            'question' => $this->question,
            'tags_list' => $this->tags_list,
            'locale' => $this->localed,
            'published_at' => $this->published_at

        ]);

        if(!empty($this->tags_list)) {

            $quiz->tag($this->tags_list);

        }

        $quiz->save();

        event(new QuizWasCreated($quiz, Auth::user()));

        return $quiz;
    }
}
