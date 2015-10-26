<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.09.2015
 * Time: 17:38
 */

namespace Itway\Repositories\Quiz;

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

}