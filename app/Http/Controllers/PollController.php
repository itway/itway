<?php

namespace itway\Http\Controllers;

use Auth;
use Conner\Tagging\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use itway\Http\Requests;
use Itway\Models\Poll;
use Itway\Repositories\PollRepository;
use Itway\Services\Youtube\Facades\Youtube;
use nilsenj\Toastr\Facades\Toastr;
use Itway\Validation\PollFormRequest;
use App;

class PollController extends Controller
{

    private $repository;

    public function __construct(PollRepository $repository){

        $this->repository = $repository;

    }

    /**
     * redirect if nothing found
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectNotFound()
    {
        return redirect()->to(App::getLocale()."/poll")->with(\Flash::error('Poll Not Found!!'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->repository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));

        $polls = $this->repository->getAll();

        $countUserPolls = count($polls->where('user_id', Auth::id()));

        return view('poll.index', compact('polls', 'countUserPolls'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tagCollection = Tag::where('count', '>=', ENV('SUPPOSED_TAGS', 5))->get();

        $tags =  $tagCollection->lists('name', 'id');

        $countUserPolls = $this->repository->countUserPolls();

        return view('poll.create', compact('tags', 'countUserPolls'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function personalPolls(){

        if (Auth::user()){

            try {
                $this->repository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));
                $polls= $this->repository->getAllUsers();

                $countUserPolls = count($polls->where('user_id', Auth::id()));

                if(count($polls) === 0)
                {
                    Toastr::warning(trans('messages.noPollsFound'), $title = trans('messages.noPollsFoundTitle'), $options = []);

                    return redirect()->back();
                }
                else {

                    return view('poll.index', compact('polls', 'countUserPolls'));
                }

            } catch (ModelNotFoundException $e) {

                return $this->redirectNotFound();
            }

        }
    }

    /**
     * store the poll
     *
     * @param PollFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PollFormRequest $request)
    {

        if (\Input::hasFile('image')) {

            $poll = $this->repository->createPoll($request, \Input::file('image'));
        }
        else {

            $poll = $this->repository->createPoll($request, null);

        }

        Toastr::success(trans('messages.yourPollCreated'), $title = $poll->title, $options = []);

        return redirect()->to(App::getLocale().'/poll/show/'.$poll->id);


    }


    /**
     * show single poll and pass some data to views
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($slug)

    {
        try {
            $poll = $this->repository->getModel()->findBySlugOrId($slug);

            $poll->view();

            $pollUser = $poll->user_id;

            $countUserPolls = $this->repository->countUserPolls();


            if(Auth::user() && Auth::user()->id === $pollUser) {

                $createdByUser = true;

                return view('poll.single', compact('poll', 'createdByUser','countUserPolls'));
            }
            else {
                $createdByUser = false;

                return view('poll.single', compact('poll','createdByUser','countUserPolls'));
            }
        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if($deleted) {

            Toastr::success(Auth::user()->name, $title = 'Your Poll deleted successfully! Have a nice day!', $options = []);

            return redirect()->to(App::getLocale().'/poll');
        }
    }

    public function tags($slug) {

        $polls = Poll::withAnyTag([$slug])->latest('published_at')->published()->paginate(8);

        $countUserPolls = $this->repository->countUserPolls();

        return view('Poll.index',compact('polls', 'countUserPolls'));
    }

}
