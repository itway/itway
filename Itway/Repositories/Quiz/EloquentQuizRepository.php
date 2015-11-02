<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.09.2015
 * Time: 17:38
 */

namespace Itway\Repositories\Quiz;

use itway\Commands\CreateQuizCommand;
use Itway\Validation\Quiz\QuizFormRequest;
use itway\Quiz;
use Illuminate\Contracts\Bus\Dispatcher;
use Itway\Uploader\ImageUploader;
use Auth;
use itway\Picture;
use Lang;
use itway\QuizOptions;

class EloquentQuizRepository implements QuizRepository {

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
     * @return int
     */
    public function perPage()
    {
        return 10;
        /**
         *
         */
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
     * @param null $searchQuery
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }
        return $this->search($searchQuery);
    }

    /**
     * @param null $searchQuery
     * @return mixed
     */
    public function allOrSearchUsers($searchQuery = null)
    {
        if (is_null($searchQuery)) {

            return $this->getAllUsers();

        }
        return $this->search($searchQuery);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->paginate($this->perPage());
    }

    /**
     * @return mixed
     */
    public function getAllUsers()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->user()->paginate($this->perPage());
    }

    /**
     * @param mixed $searchQuery
     * @return mixed
     */
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('name', 'like', $search)
            ->orWhere('slug', 'like', $search)
            ->orWhere('question', 'like', $search)
            ->paginate($this->perPage());
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->getModel()->find($id);
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $operator
     * @return mixed
     */
    public function findBy($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {

        return $this->getModel()->create($data);

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

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id)
    {
        $quiz = $this->findById($id);
        if (!is_null($quiz)) {
            $quiz->delete();
            return true;
        }
        return false;
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