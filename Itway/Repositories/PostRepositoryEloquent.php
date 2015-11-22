<?php

namespace Itway\Repositories;

use Itway\Validation\Post\PostsUpdateFormRequest;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Models\Post;
use Itway\Validation\Post\PostsFormRequest;
use Auth;
use Itway\Commands\CreatePostCommand;
use Lang;
use Illuminate\Support\Str;
use Toastr;
use App;
use Itway\Uploader\ImageTrait;
use Itway\Uploader\ImageContract;
/**
 * Class PostRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository, ImageContract
{
    use ImageTrait;
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
                $request->localed = Lang::locale(),
                $request->youtube_link,
                $request->github_link
            ));

        if (!is_null($image)) {
          $this->bindImage($image, $post);
        }

        return $post;

    }

    public function updatePost(PostsUpdateFormRequest $request, $post, $image){

        $data = $request->all();

        unset($data['image']);

        $data['user_id'] = \Auth::id();

        $data['slug'] = Str::slug($data['title']);

        if ($image) {
            // upload image

            if ($post->picture()) {

               $this->bindImage($image, $post);
            }

            $post->update($data);

            $post->untag();

            $post->tag($request->input('tags_list'));

        }
        else{
            $post->update($data);

            $post->untag();

            $post->tag($request->input('tags_list'));

        }


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
