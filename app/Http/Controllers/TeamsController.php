<?php namespace itway\Http\Controllers;

use App;
use Auth;
use Conner\Tagging\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Itway\components\Country\CountryBuilder;
use Itway\components\Tags\TagsBuilder;
use Itway\Components\teamwork\Teamwork\Exceptions\UserNotInTeamException;
use itway\Http\Requests;
use Itway\Models\Team;
use Itway\Models\User;
use Itway\Repositories\TeamRepository;
use Itway\Validation\Team\TeamRequest;
use Itway\Validation\Team\UpdateTeamRequest;
use nilsenj\Toastr\Facades\Toastr;
use Teamwork;

class TeamsController extends Controller
{
    private $repository;
    private $country;
    private $tags;

    /**
     * TeamsController constructor.
     * @param TeamRepository $repository
     * @param CountryBuilder $country
     * @param TagsBuilder $tags
     */
    public function __construct(TeamRepository $repository, CountryBuilder $country, TagsBuilder $tags)
    {
        $this->middleware('auth', ['only' => ['createTeam', 'edit', 'update', 'store']]);
        $this->repository = $repository;
        $this->country = $country;
        $this->tags = $tags;
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect()->to(route("itway::teams::index"))->with(Toastr::error('Team Not Found!', $title = 'team might be deleted or banned', $options = []));
    }

    /**
     * redirect error
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectError($message = null)
    {
        if (!is_null($message)) {
            return redirect()->to(route("itway::teams::index"))->with(Toastr::error($message, $title = "Error", $options = []));
        } else return redirect()->to(route("itway::teams::index"))->with(Toastr::error("Error appeared!", $title = Auth::user()->name, $options = []));
    }

    /**
     * show paginated teams
     * with criteria search
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->repository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));

        $teams = $this->repository->getAll();

        $tags = $this->repository->getModel()->existingTags();

        return view('teams.teams', compact('teams', 'tags'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tagCollection = Tag::where('count', '>=', ENV('SUPPOSED_TAGS', 5))->get();

        $tags = $tagCollection->lists('name', 'id');

        $countryBuilder = $this->country->buildCountrySelect();

        $tagsBuilder = $this->tags->tagsTechMultipleSelect(trans('team-form.select-tags'));
        $tagsTrendBuilder = $this->tags->tagsTrendsMultipleSelect(trans('team-form.select-trend-tags'));

        flash()->info(trans('messages.createTeam'));

        return view('teams.create', compact('tags', 'countryBuilder', 'tagsBuilder', 'tagsTrendBuilder'));
    }

    public function show($id)
    {
        if(!Auth::guest()) {

            $team = Team::findBySlugOrId($id);
            return view('teams.single', compact('team'));

        }
        else {

            return redirect()->to('auth/login');
        }
    }

    public function store(TeamRequest $request)
    {

        $logo = \Input::hasFile('logo') ? \Input::file('logo') : null;

        $team = $this->repository->createTeam($request, $logo);

        Toastr::success(trans('messages.yourTeamCreated'), $title = $team->name, $options = []);

        return redirect()->to(App::getLocale() . '/teams/' . $team->id);
    }

    public function edit($id)
    {
    }

    /**
     * @param UpdateTeamRequest $request
     * @param $id
     */
    public function update(UpdateTeamRequest $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
    }

    public function team($id)
    {

        $user = User::findBySlugOrId($id);

        $team = $this->repository->getModel()->where('user_id', $user->id)->first();
        dd($team);

    }

    /**
     * get the list of tags defined for teams
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tags($slug)
    {

        $teams = Team::withAnyTag([$slug])->latest('created_at')->paginate(8);
        $tags = $this->repository->getModel()->existingTags();

        return view('teams.teams', compact('teams', 'tags'));
    }

    /**
     * send an invite
     *
     * @param $team_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invite($team_id)
    {
        if (!Auth::guest()) {
            $user = Auth::user();
            $team = Team::find($team_id);

            Teamwork::inviteToTeam($user, $team, function ($invite) {
                // Send email to user / let them know that they got invited
            });
        } else return $this->redirectError('you are not logged in...');
    }

    /**
     * invite only via email
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function inviteViaEmail(Request $request)
    {

        if (!Teamwork::hasPendingInvite($request->email, $request->team)) {
            Teamwork::inviteToTeam($request->email, $request->team, function ($invite) {
                // Send email to user
            });
        } else {
            return $this->redirectError('user already invited...');
        }
    }

    /**
     * rejectInvite invite taken from
     * user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectInvite(Request $request)
    {

        $invite = Teamwork::getInviteFromDenyToken($request->token); // Returns a TeamworkInvite model or null

        if ($invite) // valid token found
        {
            Teamwork::denyInvite($invite);
        } else return $this->redirectError('No invites found...');


    }

    /**
     * acceptInvite invite taken from
     * user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptInvite(Request $request)
    {

        $invite = Teamwork::getInviteFromAcceptToken($request->token); // Returns a TeamworkInvite model or null

        if ($invite) // valid token found
        {
            Teamwork::acceptInvite($invite);
        } else return $this->redirectError('No invites found...');
    }

    /**
     * change the team
     *
     * @param $team_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchTeam($team_id)
    {
        try {
            if (!Auth::guest()) {
                Auth::user()->switchTeam($team_id);
                // Or remove a team association at all
//                Auth::user()->switchTeam( null );
            } else return $this->redirectError('you are not logged in...');

        } catch (UserNotInTeamException $e) {
            return $this->redirectError('Given team is not allowed for the you...');
        }
    }
}
