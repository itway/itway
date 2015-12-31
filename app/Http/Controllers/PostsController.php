<?php namespace itway\Http\Controllers;


use App;
use Conner\Tagging\Model\Tag;
use Illuminate\Contracts\Cookie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Itway\components\Tags\TagsBuilder;
use itway\Http\Requests;
use Itway\Models\Post;
use Itway\Repositories\PostRepository;
use Itway\Services\Youtube\Facades\Youtube;
use Itway\Validation\Post\PostsFormRequest;
use Itway\Validation\Post\PostsUpdateFormRequest;
use nilsenj\Toastr\Facades\Toastr;

/**
 * Class PostsController
 * @package itway\Http\Controllers
 */
class PostsController extends Controller
{

    private $repository;
    private $tags;


    /**
     * PostsController constructor.
     * @param PostRepository $repository
     * @param TagsBuilder $tags
     */
    public function __construct(PostRepository $repository, TagsBuilder $tags)
    {
        $this->middleware('auth', ['only' => ['create', 'edit', 'update', 'store']]);
        $this->repository = $repository;
        $this->tags = $tags;
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect()->to(App::getLocale() . '/blog')->with(Toastr::error('Post Not Found!', $title = 'the post might be deleted or banned', $options = []));
    }

    /**
     * redirect error
     * @param null $code
     * @return mixed
     */
    protected function redirectError($code = null)
    {
        return redirect()->to(App::getLocale() . '/blog')->with(Toastr::error("Error appeared!", $title = isset($code) ? $code : null, $options = []));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->repository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));

        $posts = $this->repository->getAll();

        $countUserPosts = $this->repository->countUserPosts();

        $tags = $this->repository->getModel()->existingTags();

        return view('pages.blog', compact('posts', 'countUserPosts', 'tags'));

    }

    public function getPageBody($id)
    {
        $body = $this->repository->getModel()->findOrFail($id)->body()->first();

        return response()->json(['body' => $body]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tagCollection = Tag::where('count', '>=', ENV('SUPPOSED_TAGS', 5))->get();

        $tags = $tagCollection->lists('name', 'id');

        $tagsBuilder = $this->tags->tagsTechMultipleSelect("choose" . trans('post-form.tags'));

        $countUserPosts = $this->repository->countUserPosts();

        flash()->info(trans('messages.createLang'));

        return view('posts.create', compact('tags', 'countUserPosts', 'tagsBuilder'));
    }

    /**
     * store the posts data in database and bind the image
     *
     * @param PostsFormRequest $request
     * @return mixed
     */
    public function store(PostsFormRequest $request)
    {

        $image = \Input::hasFile('image') ? \Input::file('image') : null;

        $post = $this->repository->createPost($request, $image);

        Toastr::success(trans('messages.yourPostCreated'), $title = $post->title, $options = []);

        return redirect()->to(App::getLocale() . '/blog/post/' . $post->id);

    }


    /**
     * show single post and pass some data to views
     *
     * @param $slug
     * @param Post $postdata
     * @return \Illuminate\View\View|Response
     */
    public function show($slug, Post $postdata)

    {
        try {
            $post = $postdata->findBySlugOrId($slug);

            $post->view();

            $postUser = $post->user_id;

            $countUserPosts = $this->repository->countUserPosts();

            $modelName = $this->repository->getModelName();

            if (Auth::user() && Auth::user()->id === $postUser) {

                $createdByUser = true;

                return view('posts.single', compact('post', 'createdByUser', 'countUserPosts', 'modelName'));
            } else {
                $createdByUser = false;

                return view('posts.single', compact('post', 'createdByUser', 'countUserPosts', 'modelName'));
            }
        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }

    }

    public function userPosts(Request $request)
    {
        try {

            $posts = $this->repository->getAllUsers();

            $countUserPosts = $this->repository->countUserPosts();

            $tags = $this->repository->getModel()->existingTags();

            if ($countUserPosts === 0) {

                if ($request->ajax()) {
                    Toastr::warning(trans('messages.noPostsFound'), $title = trans('messages.noPostsFoundTitle'), $options = []);
                } else {
                    Toastr::warning(trans('messages.noPostsFound'), $title = trans('messages.noPostsFoundTitle'), $options = []);
                    return redirect()->back();
                }
            } else {
                if ($request->ajax()) {
                    return view('posts.dynamic-posts', compact('posts', 'countUserPosts', 'tags'));
                } else {
                    return view('pages.blog', compact('posts', 'countUserPosts', 'tags'));
                }
            }

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return Response
     */
    public function edit($slug)

    {
        try {
            $post = Post::findBySlugOrId($slug);

            $countUserPosts = $this->repository->countUserPosts();

            $tags = $post->tagNames();

            if ($post->picture()) {

                $picture = $post->picture()->get();

            }

            $body = $post->getBody();

            flash()->info(trans('messages.createLang'));

            $tagsBuilder = $this->tags->tagsTechMultipleSelect("choose" . trans('post-form.tags'), $tags);

            return view('posts.edit', compact('post', 'tags', 'body', 'picture', 'countUserPosts', 'tagsBuilder'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }

    }

    /**
     * @param $slug
     * @param PostsUpdateFormRequest $request
     * @return Redirect
     */
    public function update($slug, PostsUpdateFormRequest $request)
    {
        try {
            $post = Post::findBySlugOrId($slug);
            $image = \Input::file('image');
            $this->repository->updatePost($request, $post, $image);
            $updatedPost = $post->id;
            Toastr::success(trans('messages.yourPostUpdated'), $title = $post->title, $options = []);

            return redirect()->to(App::getLocale() . '/blog/post/' . $updatedPost);


        } catch (ModelNotFoundException $e) {

            return $this->redirectError();

        }
    }

    /**
     * just deleting posts if the post belongs to user or the user is admin
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->repository->deleteAll($id);

        Toastr::success(Auth::user()->name, $title = 'Your Post deleted successfully! Have a nice day!', $options = []);

        return redirect()->to(App::getLocale() . '/blog');
    }

    /**
     * list posts according to the tags
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tags($slug)
    {

        $posts = Post::withAnyTag([$slug])->latest('published_at')->published()->paginate(8);

        $countUserPosts = $this->repository->countUserPosts();

        $tags = $this->repository->getModel()->existingTags();

        return view('pages.blog', compact('posts', 'countUserPosts', 'tags'));
    }


}
