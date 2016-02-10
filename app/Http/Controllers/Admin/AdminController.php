<?php

namespace itway\Http\Controllers\Admin;

use Illuminate\Http\Request;

use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use Itway\Repositories\EventRepository;
use Itway\Repositories\PostRepository;
use Itway\Repositories\TeamRepository;
use Itway\Repositories\UserRepository;

class AdminController extends Controller
{
    private $postRepository;
    private $eventRepository;
    private $teamRepository;
    private $userRepository;

    public function __construct(PostRepository $postRepository, EventRepository $eventRepository, TeamRepository $teamRepository, UserRepository $userRepository){

        $this->postRepository = $postRepository;
        $this->eventRepository = $eventRepository;
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countTodayPosts = $this->postRepository->todayPosts();
        $countTodayEvents = $this->eventRepository->todayEvents();
        $countTodayTeams = $this->teamRepository->todayTeams();
        $countTodayUsers = $this->userRepository->todayUsersCount();

        return view('admin.dashboard', compact('countTodayPosts', 'countTodayEvents', 'countTodayTeams', 'countTodayUsers'));
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
