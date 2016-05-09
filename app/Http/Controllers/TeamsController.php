<?php namespace itway\Http\Controllers;

use App;
use Auth;
use TagsCloud\Tagging\Model\TeamTag as Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Itway\components\Country\CountryBuilder;
use Itway\components\Tags\TagsBuilder;
use Itway\Components\teamwork\Teamwork\Exceptions\UserNotInTeamException;
use itway\Http\Requests;
use Itway\Models\Team;
use Itway\Repositories\TeamRepository;
use Itway\Repositories\UserRepository;
use Itway\Validation\Team\TeamRequest;
use Itway\Validation\Team\UpdateTeamRequest;
use nilsenj\Toastr\Facades\Toastr;
use Teamwork;
/**
 * Class TeamsController
 * @package itway\Http\Controllers
 */
class TeamsController extends Controller
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
        if(!Auth::guest()) {
            $currentTeam = $this->userRepository->getModel()->find(Auth::user()->id)->currentTeam;

        } else {
            $currentTeam = null;
        }
        return view('teams.teams', compact('teams', 'tags', 'currentTeam'));
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
        if(!Auth::guest()) {
            $currentTeam = $this->userRepository->getModel()->find(Auth::user()->id)->currentTeam;

        } else {
            $currentTeam = null;
        }

        flash()->info(trans('messages.createTeam'));

        return view('teams.create', compact('tags', 'countryBuilder', 'tagsBuilder', 'tagsTrendBuilder', 'currentTeam'));
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $team = Team::findBySlugOrId($id);
        if(!Auth::guest()) {
            $currentTeam = $this->userRepository->getModel()->find(Auth::user()->id)->currentTeam;
            $teamMember = $this->repository->isTeamMember($team->id, $currentTeam->id);

        } else {
            $currentTeam = null;
        }

        if (!Auth::guest() && Auth::user()->id === head($team->ownerId())) {
            $createdByUser = true;
        } else {
            $createdByUser = false;
        }
        return view('teams.single', compact('team', 'teamMember', 'currentTeam', 'createdByUser'));
    }

    /**
     * @param TeamRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeamRequest $request)
    {
        $logo = \Input::hasFile('logo') ? \Input::file('logo') : null;
        $team = $this->repository->createTeam($request, $logo);
        Toastr::success(trans('messages.yourTeamCreated'), $title = $team->name, $options = []);
        return redirect()->to(App::getLocale() . '/teams/team/' . $team->id);
    }

    /**
     * @param $id
     */
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
     * just deleting events if the event belongs to user or the user is admin
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->repository->deleteAll($id);

        Toastr::success(Auth::user()->name, $title = 'Your Team deleted successfully! Have a nice day!', $options = []);

        return redirect()->to(App::getLocale() . '/teams');
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function team($id)
    {

        $team = Team::findBySlugOrId($id);
        if(!Auth::guest()) {
            $currentTeam = $this->userRepository->getModel()->find(Auth::user()->id)->currentTeam;
            if(!is_null($currentTeam)) {
                $teamMember = $this->repository->isTeamMember($team->id, $currentTeam->id);
            }
            else $teamMember = null;
            $team->view();

        } else {
            $currentTeam = null;
        }

        $ownerId = head($team->ownerId());
        if (!Auth::guest() && Auth::user()->id === $ownerId) {

            $createdByUser = true;
        }
        else {
            $createdByUser = false;
        }
        $owner = \Itway\Models\User::findBySlugOrId($ownerId);
        $team->load('trends','users');
        return view('teams.single', compact('team', 'teamMember', 'ownerId', 'owner', 'currentTeam', 'createdByUser'));

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
        if(!Auth::guest()) {
            $currentTeam = $this->userRepository->getModel()->find(Auth::user()->id)->currentTeam;

        } else {
            $currentTeam = null;
        }

        return view('teams.teams', compact('teams', 'tags', 'currentTeam'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teamAlreadyExists()
    {
        $userID = Auth::user()->id;
        $currentTeam = $this->userRepository->getModel()->find($userID)->currentTeam;
        $team = Team::findBySlugOrId($currentTeam->id);
        $tags = $this->repository->getModel()->existingTags();
        if ($userID === head($team->ownerId())) {
            $createdByUser = true;
            flash()->warning(trans('messages.TeamExistsAdmin'));

        } else {
            $createdByUser = false;
            flash()->warning(trans('messages.TeamExistsUser'));

        }
        return view('teams.alreadyexists', compact('team', 'tags', 'currentTeam', 'createdByUser'));
    }
    /**
     * send an invite
     *
     * @param $team_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invite($team_id)
    {
        $user = Auth::user();
        $team = Team::find($team_id);
        Teamwork::inviteToTeam($user, $team, function ($invite) {
            // Send email to user / let them know that they got invited
        });
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
            Auth::user()->switchTeam($team_id);
            // Or remove a team association at all
//                Auth::user()->switchTeam( null );
        } catch (UserNotInTeamException $e) {
            return $this->redirectError('Given team is not allowed for you...');
        }
    }
}
