<?php

namespace itway\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Itway\components\Country\CountryBuilder;
use Itway\components\Tags\TagsBuilder;
use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use Itway\Models\Team;
use Itway\Repositories\TeamRepository;
use Itway\Repositories\UserRepository;
use Itway\Validation\Team\TeamRequest;
use Itway\Validation\Team\UpdateTeamRequest;
use nilsenj\Toastr\Facades\Toastr;

class AdminTeamsController extends Controller
{

    /**
     * @var TeamRepository
     */
    private $repository;
    /**
     * @var CountryBuilder
     */
    private $country;
    /**
     * @var TagsBuilder
     */
    private $tags;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * TeamsController constructor.
     * @param TeamRepository $repository
     * @param CountryBuilder $country
     * @param TagsBuilder $tags
     */
    public function __construct(TeamRepository $repository, CountryBuilder $country, TagsBuilder $tags, UserRepository $userRepository)
    {
        $this->middleware('auth', ['only' => ['create', 'show', 'team', 'invite', 'edit', 'update', 'switchTeam', 'store']]);
        $this->repository = $repository;
        $this->country = $country;
        $this->tags = $tags;
        $this->userRepository = $userRepository;
    }
    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect()->to(\App::getLocale() . '/admin/teams');
    }

    /**
     * Display a listing of teams
     *
     * @return Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));
        $tags = $this->repository->getModel()->existingTags();
        if(!Auth::guest()) {

            $currentTeam = $this->userRepository->getModel()->find(Auth::user()->id)->currentTeam;

        } else {

            $currentTeam = null;

        }
        $teams = $this->repository->paginate();

        $no = $teams->firstItem();

        return view('admin.teams.index', compact('teams', 'tags', 'currentTeam', 'no'));
    }


    /**
     * @param TeamRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeamRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->to(\App::getLocale() . '/admin/teams');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function show($id)
    {
        try {
            $team = Team::find($id);

            return view('admin.teams.show', compact('team', 'role'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }
    }

    /**
     * edit page for teams
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function edit($id)
    {
        try {

            $team = Team::find($id);

            $users = $team->users()->get();

            return view('admin.teams.edit', compact('team', 'users'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }
    }

    /**
     * update teams data
     *
     * @param UpdateTeamRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function update(UpdateTeamRequest $request, $id)
    {
        try {
            $data = $request->all();

            $team = Team::find($id);

            $team->update($data);

            return redirect()->back();

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }
    }

    /**
     *  delete team
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function destroy($id)
    {
        try {
            $team = Team::find($id);
            $teamname = $team->name;


            if (!Auth::user()->isTeamOwner() || !Auth::user()->hasRole("Admin")) {
                Toastr::error('Can\'t be deleted!', $title = $teamname, $options = []);

                return redirect()->back();

            } else {
                Toastr::success('Team deleted!', $title = $teamname, $options = []);
                $this->repository->delete($id);
            }
            return redirect()->back();

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }
    }

    public function banORunBan($id)
    {
        try {
            $team = Team::find($id);
            $teamname = $team->name;

            if (!Auth::user()->isTeamOwner() || !Auth::user()->hasRole("Admin")) {

                Toastr::error('Can\'t be banned!', $title = $teamname, $options = []);

                return redirect()->back();
            } else {

                $this->repository->banORunBan($id);
            }
            return redirect()->back();

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }

    }
}
