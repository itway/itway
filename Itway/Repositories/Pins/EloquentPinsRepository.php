<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 7/20/2015
 * Time: 1:56 AM
 */

namespace Itway\Repositories\Pins;

use itway\Post;
use itway\Pin;

class EloquentPinsRepository implements PinsRepository
{

    public function perPage()
    {
        return 10;
    }
    public function getModel()
    {
        $model = Pin::class;

        return new $model;
    }
    public function getPostModel(){

        $postmodel = Post::class;

        return new $postmodel;
    }
    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }
        return $this->search($searchQuery);
    }
    public function getAllPosts()
    {
        return $this->getPostModel()->latest('published_at')->published()->localed()->paginate($this->perPage());
    }
    public function getAll()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->paginate($this->perPage());
    }
    public function getUserPinnedPosts()
    {
        $posts = [];

//        $this->getAllPosts()->getUserPinnedIds();

            foreach($this->getAllPosts() as $key => $post)
            {
                $posts[$key] = $post->getUserPinnedIds()->first()['object_id'];
            }

        return $posts;


    }

    public function getPostPinnedIds()
    {
        $posts = $this->getAllPosts();

        $pp = [];
        foreach($posts as $key => $post)
        {
            $pp[$key]= $post->getUserPinnedIds()->first()['object_id'];
        }
        return array_filter($pp);
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