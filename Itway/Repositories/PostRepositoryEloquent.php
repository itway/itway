<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\PostRepository;
use Itway\Models\Post;
use Itway\Validation\Post\PostsFormRequest;
use Auth;
use Illuminate\Contracts\Bus\Dispatcher;
use Itway\Commands\CreatePostCommand;
use Itway\Repositories\EloquentRepository;
use Lang;
use Itway\Models\Picture;
use Itway\Uploader\ImageUploader;

/**
 * Class PostRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title' => 'like',
        'body' => 'like',
        'preamble' => 'like'
    ];
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
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

    /**
     * ban or unban the user
     *
     * @param $id
     */
    public function banORunBan($id)
    {
        $post = $this->find($id);

        if ($post->banned === 0) {

            \Toastr::warning('Post banned!', $title = $post->title, $options = []);

            $post->banned = true;

        }
        else {
            \Toastr::info('Post unbanned!', $title = $post->title, $options = []);

            $post->banned = false;
        }

        $post->update();
    }


}
