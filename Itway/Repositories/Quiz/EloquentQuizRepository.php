<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.09.2015
 * Time: 17:38
 */

namespace Itway\Repositories\Quiz;

use itway\Commands\CreateQuizCommand;
use Itway\Repositories\EloquentRepository;
use Itway\Validation\Quiz\QuizFormRequest;
use itway\Quiz;
use Illuminate\Contracts\Bus\Dispatcher;
use Itway\Uploader\ImageUploader;
use Auth;
use itway\Picture;
use Lang;
use itway\QuizOptions;

class EloquentQuizRepository extends EloquentRepository implements QuizRepository {

    /**
     * constructor takes Dispatcher and ImageUploader instances
     *
     * @param Dispatcher $dispatcher
     * @param ImageUploader $uploader
     */
    public function __construct(Dispatcher $dispatcher, ImageUploader $uploader){
        $this->dispatcher = $dispatcher;
        $this->uploader = $uploader;
    }

   

    /**
     * @return mixed
     */
    public function getModel()
    {
        $model = Quiz::class;

        return new $model;
    }



    /**
     * @param QuizFormRequest $request
     * @param $image
     * @return mixed
     */
    public function createQuiz(QuizFormRequest $request, $image = null){

        $quiz = $this->dispatcher->dispatch(
            new CreateQuizCommand(
                $request->name,
                $request->question,
                $request->tags_list,
                $request->published_at,
                $request->localed = Lang::locale()
            ));

        $this->bindImage($image, $quiz);

        $this->bindOptions($quiz, $request->options);

        return $quiz;
    }


    protected function bindOptions($quiz, $options) {

        $options = remove_empty($options);

        foreach($options as $option) {

            QuizOptions::create([
                "quiz_id" => $quiz->id,
                "option" => $option
            ]);

        }
    }

    /**
     * bind an image to quiz
     * @param $image
     * @param $quiz
     */
    protected function bindImage($image, $quiz){

        $this->uploader->upload($image, config('image.quizzesDESTINATION'))->save(config('image.quizzesDESTINATION'));

        $picture = Picture::create(['path' => $this->uploader->getFilename()]);

        $quiz->picture()->attach($picture);
    }

    /**
     * return the number of user's posts
     *
     * @return mixed
     */
    public function countUserQuizzes(){

        return $this->getModel()->where('user_id', '=', Auth::id())->count();
    }

    /**
     * return the number of today's posts
     *
     * @return mixed
     */
    public function todayQuizzes(){

        return $this->getModel()->latest('published_at')->published()->today()->count();

    }

}