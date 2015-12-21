<?php

namespace itway\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use Itway\Repositories\PostRepository;
use Itway\Repositories\UserRepository;
use Itway\Models\Post;
use nilsenj\Toastr\Facades\Toastr;

class AdminPostsController extends Controller
{
    private $userRepository;
    private $postRepository;

    public function __construct(UserRepository $userRepository, PostRepository $postRepository)
    {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $this->postRepository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));
        $posts = $this->postRepository->paginate();
        $no = $posts->firstItem();

        $countUserPosts = $this->postRepository->countUserPosts();


        return view('admin.posts.index',compact('posts','countUserPosts','no'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function banORunBan($id) {
        try {

            $post = Post::find($id);

            if(\Auth::user()->id === $post->user->id || !\Auth::user()->hasRole('Admin')) {

                Toastr::error('Can\'t be banned!', $title = $post->title, $options = []);

                return redirect()->back();
            }
            else {

                $this->postRepository->banORunBan($id);
            }
            return redirect()->back();

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }
    }
}
