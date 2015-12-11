<?php namespace itway\Http\Controllers;

use itway\Http\Requests;
use itway\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Itway\Models\Team;
use Itway\Models\User;
use Itway\Repositories\TeamRepository;
use Conner\Tagging\Tag;
use Illuminate\Support\Facades\Response;
use Itway\Validation\Team\TeamRequest;
use Itway\Validation\Team\UpdateTeamRequest;
use Toastr;
use App;
use Teamwork;
use Auth;
use Itway\Components\teamwork\Teamwork\Exceptions\UserNotInTeamException;

class TeamsController extends Controller {


	private $repository;

    /**
     * @param  $repository
     */
    public function __construct(TeamRepository $repository)
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
        return redirect()->to(route("itway::teams::index"))->with(Toastr::error('Team Not Found!',$title = 'team might be deleted or banned', $options = []));
    }

    /**
     * redirect error
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectError($message = null)
    {
        if (!is_null($message))
        {
            return redirect()->to(route("itway::teams::index"))->with(Toastr::error($message, $title = "Error", $options = []));
        }
        else return redirect()->to(route("itway::teams::index"))->with(Toastr::error("Error appeared!", $title = Auth::user()->name, $options = []));
    }

    public function index()
    {
        $this->repository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));

        $teams = $this->repository->getAll();

        $tags = $this->repository->getModel()->existingTags();

        return view('teams.teams', compact('teams', 'tags'));
    }
    
    public function show($id) {}
    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tagCollection = Tag::where('count', '>=', ENV('SUPPOSED_TAGS', 5))->get();

        $tags =  $tagCollection->lists('name', 'id');

        flash()->info(trans('messages.createTeam'));

        return view('teams.create', compact('tags'));

    }

    public function store(TeamRequest $request) {

        $logo = \Input::hasFile('logo') ? \Input::file('logo') : null;

        $team = $this->repository->createTeam($request, $logo);

        Toastr::success(trans('messages.yourTeamCreated'), $title = $team->name, $options = []);

        return redirect()->to(App::getLocale().'/teams/'.$team->id);
    }

  	public function edit($id){}

    /**
     * @param UpdateTeamRequest $request
     * @param $id
     */
	public function update(UpdateTeamRequest $request, $id){}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){}

    public function invite($team_id)
    {
        if (!Auth::guest())
        {
            $user = Auth::user();
            $team = Team::find($team_id);

            Teamwork::inviteToTeam( $user , $team, function( $invite )
            {
                // Send email to user / let them know that they got invited
            });
        }
        else return $this->redirectError('you are not logged in...');
    }
    public function inviteViaEmail(Request $request) {

        if( !Teamwork::hasPendingInvite( $request->email, $request->team) )
        {
            Teamwork::inviteToTeam( $request->email, $request->team, function( $invite )
            {
                // Send email to user
            });
        } else {
            return $this->redirectError('user already invited...');
        }
    }

    public function rejectInvite(Request $request)	{

        $invite = Teamwork::getInviteFromDenyToken( $request->token ); // Returns a TeamworkInvite model or null

        if( $invite ) // valid token found
        {
            Teamwork::denyInvite( $invite );
        }
        else return $this->redirectError('No invites found...');


    }

    public function acceptInvite(Request $request)	{

        $invite = Teamwork::getInviteFromAcceptToken( $request->token ); // Returns a TeamworkInvite model or null

        if( $invite ) // valid token found
        {
            Teamwork::acceptInvite( $invite );
        }
        else return $this->redirectError('No invites found...');
    }

    public function switchTeam($team_id) {
        try {
            if (!Auth::guest())
            {
                Auth::user()->switchTeam( $team_id );
                // Or remove a team association at all
//                Auth::user()->switchTeam( null );
            }
            else return $this->redirectError('you are not logged in...');

        } catch( UserNotInTeamException $e )
        {
            return $this->redirectError('Given team is not allowed for the you...');
        }
    }
}
