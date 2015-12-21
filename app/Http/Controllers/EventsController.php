<?php

namespace itway\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use Itway\Repositories\EventRepository;
use nilsenj\Toastr\Facades\Toastr;

class EventsController extends Controller
{
    private $repository;

    /**
     * @param  $repository
     */
    public function __construct(EventRepository $repository)
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
        return redirect()->to(route("itway::events::index"))->with(Toastr::error('Event Not Found!',$title = 'team might be deleted or banned', $options = []));
    }

    /**
     * redirect error
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectError($message = null)
    {
        if (!is_null($message))
        {
            return redirect()->to(route("itway::events::index"))->with(Toastr::error($message, $title = "Error", $options = []));
        }
        else return redirect()->to(route("itway::events::index"))->with(Toastr::error("Error appeared!", $title = Auth::user()->name, $options = []));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));

        $events = $this->repository->getAll();

        $countUserEvents = $this->repository->countUserEvents();

        $tags = $this->repository->getModel()->existingTags();

        return view('events.events', compact('events','countUserEvents', 'tags'));
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
}
