<?php

namespace Itway\Repositories;

use Itway\Uploader\ImageContract;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\QuizRepository;
use Itway\Models\Quiz;
use itway\Commands\CreateQuizCommand;
use Itway\Repositories\EloquentRepository;
use Itway\Validation\Quiz\QuizFormRequest;
use Illuminate\Contracts\Bus\Dispatcher;
use Itway\Uploader\ImageUploader;
use Auth;
use Itway\Models\Picture;
use Lang;
use Itway\Models\QuizOptions;
/**
 * Class QuizRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class QuizRepositoryEloquent extends BaseRepository implements QuizRepository, ImageContract
{
    use ImageTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Quiz::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        $model = Quiz::class;

        return new $model;
    }

    /** fetch all paginated, published and localed posts */
    public function getAll()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->paginate();
    }
    /** fetch all users paginated, published and localed posts */
    public function getAllUsers()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->users()->paginate();
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
