<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.09.2015
 * Time: 17:38
 */

namespace Itway\Repositories\Quiz;

use itway\Http\Requests\QuizFormRequest;
use itway\Quiz;

class EloquentQuizRepository implements QuizRepository {

    public function perPage()
    {
        return 10;
    }
    public function getModel()
    {
        $model = Quiz::class;

        return new $model;
    }
    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }
        return $this->search($searchQuery);
    }
    public function allOrSearchUsers($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAllUsers();
        }
        return $this->search($searchQuery);
    }
    public function getAll()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->paginate($this->perPage());
    }
    public function getAllUsers()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->users()->paginate($this->perPage());
    }
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('title', 'like', $search)
            ->orWhere('slug', 'like', $search)
            ->orWhere('preamble', 'like', $search)
            ->orWhere('body', 'like', $search)
            ->orWhere('comment_count', 'like', $search)
            ->paginate($this->perPage())
            ;
    }
    public function findById($id)
    {
        return $this->getModel()->find($id);
    }
    public function findBy($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }
    public function delete($id)
    {
        $post = $this->findById($id);
        if (!is_null($post)) {
            $post->delete();
            return true;
        }
        return false;
    }
    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }
    public function createQuiz(QuizFormRequest $request, $image){

        $post = $this->dispatcher->dispatch(
            new CreatePostCommand(
                $request->title,
                $request->preamble,
                $request->body,
                $request->tags_list,
                $request->published_at,
                $request->localed = Lang::locale()
            ));

        $this->bindImage($image, $post);

        return $post;
    }

    /**
     * bind an image to the post
     *
     * @param $image
     * @param $post
     */
    protected function bindImage($image, $post){

        $this->uploader->upload($image, config('image.postsDESTINATION'))->save(config('image.postsDESTINATION'));

        $picture = Picture::create(['path' => $this->uploader->getFilename()]);

        $post->picture()->attach($picture);
    }

    /**
     * return the number of user's posts
     *
     * @return mixed
     */
    public function countUserPosts(){

        return $this->getModel()->where('user_id', '=', Auth::id())->count();
    }

    /**
     * return the number of today's posts
     *
     * @return mixed
     */
    public function todayPosts(){
        return $this->getModel()->latest('published_at')->published()->today()->count();
    }


}