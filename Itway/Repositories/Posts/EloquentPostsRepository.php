<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 7/20/2015
 * Time: 1:56 AM
 */

namespace Itway\Repositories\Posts;


use itway\Post;
use Auth;
use Illuminate\Contracts\Bus\Dispatcher;
use itway\Commands\CreatePostCommand;
use Itway\Repositories\EloquentRepository;
use Itway\Validation\Post\PostsFormRequest;
use Lang;
use itway\Picture;
use Itway\Uploader\ImageUploader;


class EloquentPostsRepository extends EloquentRepository implements PostsRepository
{
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
     * get the model instance
     *
     * @return mixed
     */
    public function getModel()
    {
        $model = Post::class;

        return new $model;
    }

    /**
     * create the post
     * and dispatch the command
     *
     * @param PostsFormRequest $request
     * @param $image
     * @return mixed
     */
    public function createPost(PostsFormRequest $request, $image){

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