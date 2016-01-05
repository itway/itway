<?php

namespace Itway\Repositories;

use App;
use Auth;
use Illuminate\Support\Str;
use Itway\Commands\CreatePostCommand;
use Itway\Models\Post;
use Itway\Uploader\ImageTrait;
use Itway\Validation\Poll\PollFormRequest;
use Itway\Validation\Post\PostsFormRequest;
use Itway\Validation\Post\PostsUpdateFormRequest;
use Lang;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use Toastr;

/**
 * Class PostRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
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

    /** fetch all USERS' paginated, published and localed posts */
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
    public function createPost(PostsFormRequest $request, $image)
    {
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

    /**
     * @param PostsUpdateFormRequest $request
     * @param $post
     * @param $image
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function updatePost(PostsUpdateFormRequest $request, $post, $image)
    {
        try {

            $data = $request->all();

            unset($data['image']);
            unset($data['body']);

            $data['user_id'] = \Auth::id();
            $data['slug'] = Str::slug($data['title']);
            if ($image) {
                $this->bindImage($image, $post);
            }
            $post->update($data);
            $post->body()->update(["body" => $request->body]);
            $post->untag();
            $post->tag($request->input('tags_list'));

        } catch (\Exception $e) {

            return response("error appeared can't update " . $e->getMessage(), $e->getCode());

        }
    }

    /**
     * delete post && attached body && attached tags
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAll($id)
    {
        try {
            $post = $this->getModel()->find($id);
            $post->body()->delete();
            $post->untag();
            $this->delete($id);
        } catch (\Exception $e) {
            return response("error appeared " . $e->getMessage(), $e->getCode());
        }
    }

    /**
     * bind poll to the existing post
     *
     * @param PollFormRequest $request
     * @param $post
     */
    public function bindPoll(PollFormRequest $request, $post)
    {
    }

    /**
     * return the number of user's posts
     * @return mixed
     */
    public function countUserPosts()
    {

        return $this->getModel()->where('user_id', '=', Auth::id())->count();
    }

    /**
     * return the number of today's posts
     * @return mixed
     */
    public function todayPosts()
    {

        return $this->getModel()->latest('published_at')->published()->today()->count();

    }

    /**
     * ban or unban instance
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function banORunBan($id)
    {
        try {
            $instance = $this->find($id);
            if ($instance->banned === 0) {
                \Toastr::warning(trans('bans.' . strtolower($this->getModelName())), $title = $instance->title, $options = []);
                $instance->banned = true;
            } else {
                \Toastr::info(trans('unbans.' . strtolower($this->getModelName())), $title = $instance->title, $options = []);
                $instance->banned = false;
            }
            $instance->update();
        } catch (\Exception $e) {
            return response("Error appeared. Maybe model doesn't have banned field" . $e->getMessage(), $e->getCode());
        }
    }
}
