<?php namespace itway\Http\Controllers;


use Conner\Tagging\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use itway\Http\Requests;
use Itway\Models\Post;
use Itway\Validation\Post\PostsUpdateFormRequest;
use Itway\Validation\Post\PostsFormRequest;
use Illuminate\Contracts\Cookie;
use Itway\Repositories\PostRepository;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use nilsenj\Toastr\Facades\Toastr;
use Itway\Services\Youtube\Facades\Youtube;
use Itway\Services\Youtube\YoutubeQuery;

/**
 * Class PostsController
 * @package itway\Http\Controllers
 */
class PostsController extends Controller {

    use YoutubeQuery;
    private $repository;


    /**
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->middleware('auth', ['only' => ['create', 'edit', 'update', 'store']]);
        $this->repository = $repository;
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect()->to(App::getLocale().'/blog')->with(Toastr::error('Post Not Found!',$title = 'the post might be deleted or banned', $options = []));
    }

    /**
     * redirect error
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectError()
    {
        return redirect()->to(App::getLocale().'/blog/'.Auth::id())->with(Toastr::error("Error appeared!", $title = Auth::user()->name, $options = []));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
    {
        $this->repository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));

        $posts = $this->repository->getAll();
        $countUserPosts = $this->repository->countUserPosts();

            return view('pages.blog', compact('posts','countUserPosts'));

    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tagCollection = Tag::where('count', '>=', ENV('SUPPOSED_TAGS', 5))->get();

        $tags =  $tagCollection->lists('name', 'id');

        $countUserPosts = $this->repository->countUserPosts();

        flash()->info(trans('messages.createLang'));

        return view('posts.create', compact('tags','countUserPosts'));
    }

    /**
     * store the posts data in database and bind the image
     *
     * @param PostsFormRequest $request
     * @return mixed
     */
    public function store(PostsFormRequest $request)
    {

        if (\Input::hasFile('image')) {

            $post = $this->repository->createPost($request, \Input::file('image'));
        }
        else{

            Toastr::error(trans('messages.imageError'), $title = Auth::user()->name, $options = []);

            return redirect()->back();
        }

        Toastr::success(trans('messages.yourPostCreated'), $title = $post->title, $options = []);

        return redirect()->to(App::getLocale().'/blog/post/'.$post->id);
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

            if($this->searchYoutubeRelated($post->tagNames())) {

                $videos = $this->searchYoutubeRelated($post->tagNames());
            }

            else $videos = false;

            if(Auth::user() && Auth::user()->id === $postUser) {

                $createdByUser = true;

                return view('posts.single', compact('post', 'createdByUser','countUserPosts', 'videos'));
            }
            else {
                $createdByUser = false;

                return view('posts.single', compact('post','createdByUser','countUserPosts', 'videos'));
            }
        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }

	}
    public function userPosts()

    {

            try {

                $posts = $this->repository->getAllUsers();

                $countUserPosts = $this->repository->countUserPosts();


                if($countUserPosts === 0)
                {
                    Toastr::warning(trans('messages.noPostsFound'), $title = trans('messages.noPostsFoundTitle'), $options = []);
                    return redirect()->back();
                }
                else {

                    return view('pages.blog', compact('posts', 'countUserPosts'));
                }

            } catch (ModelNotFoundException $e) {

                return $this->redirectNotFound();
            }

    }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $slug
	 * @return Response
	 */
	public function edit($slug)

	{
        try {
            $post = Post::findBySlugOrId($slug);

            $countUserPosts = $this->repository->countUserPosts();

//            $categories = Category::all()->lists("slug", 'id');

            $tags = $post->tagNames();

            if ($post->picture()) {

                $picture = $post->picture()->get() ;

            }

            return view('posts.edit', compact('post', 'tags', 'picture','countUserPosts'));


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

            return redirect()->to(App::getLocale().'/blog/post/'.$updatedPost);


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
        $this->repository->delete($id);

        Toastr::success(Auth::user()->name, $title = 'Your Post deleted successfully! Have a nice day!', $options = []);

        return redirect()->to(App::getLocale().'/blog');
	}

    /**
     * list posts according to the tags
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tags($slug) {

        $posts = Post::withAnyTag([$slug])->latest('published_at')->published()->paginate(8);

        $countUserPosts = $this->repository->countUserPosts();

        return view('pages.blog',compact('posts', 'countUserPosts'));
    }


}
