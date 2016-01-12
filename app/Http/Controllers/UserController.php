<?php namespace itway\Http\Controllers;

use App;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Input;
use Itway\components\Country\CountryBuilder;
use itway\Http\Requests;
use Itway\Models\User;
use Itway\Repositories\EventRepository;
use Itway\Repositories\PostRepository;
use Itway\Repositories\UserRepository;
use Itway\Validation\User\UserPhotoRequest;
use Itway\Validation\User\UserUpdateRequest;
use nilsenj\Toastr\Facades\Toastr;

class UserController extends Controller
{

    private $repository;
    private $postrepo;
    private $country;
    private $eventrepo;

    public function __construct(UserRepository $repository, PostRepository $postrepo, CountryBuilder $country, EventRepository $eventrepo)
    {
        $this->repository = $repository;
        $this->postrepo = $postrepo;
        $this->country = $country;
        $this->eventrepo = $eventrepo;
    }

    /**
     * redirect not found
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectNotFound()
    {
        return redirect()->to(App::getLocale() . '/user')->with(Toastr::error('User Not Found!', $title = 'the user might be deleted or banned', $options = []));
    }

    /**
     * redirect error
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectError()
    {
        return redirect()->to(App::getLocale() . '/user/' . Auth::id())->with(Toastr::error("Error appeared!", $title = Auth::user()->name, $options = []));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('user.user-profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = User::findBySlugOrId($id);
            if (Auth::user()->id == $user->id) {
                $owner = true;
            } else {
                $owner = false;
            }
            if ($user->getMedia('logo')->first()) {
                $pictures = $user->getMedia('logo');
                $picture = $pictures[0]->getPath();
            }
            $notFromProfile = false;
            $countUserPosts = $this->postrepo->countUserPosts();
            $currentTeam = $user->currentTeam;
            $countUserEvents = $this->eventrepo->countUserEvents();

            return view('user.user-profile', compact('user', 'picture', 'notFromProfile', 'countUserPosts', 'countUserEvents', 'owner', 'currentTeam'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }
    }

    public function settings(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (Auth::user()->id == $user->id) {
                $owner = true;
            } else {
                Toastr::warning('Not Allowed!', $title = 'this is not your profile...', $options = []);
                return redirect()->back();
            }

            $tags = $user->tagNames();
            $countryBuilder = $this->country->buildCountrySelect('choose your country', isset($user->country) ? $user->country : null);
            $countUserPosts = $this->postrepo->countUserPosts();
            $currentTeam = $user->currentTeam;
            $countUserEvents = $this->eventrepo->countUserEvents();

            return view('user.user-settings', compact('user', 'tags', 'owner', 'countUserPosts', 'countryBuilder', 'countUserEvents', 'currentTeam'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }
    }

    public function queryUser($query) {

           return $this->repository->queryUserWithLogo($query);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param $id
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UserUpdateRequest $request)
    {
        try {
            $user = User::findBySlugOrId($id);

            $taglist = $request->input('tags_list');

            if (!empty($taglist)) {

                $user->retag($taglist);
            }
            $country = $request->input('country');

            if (isset($country)) {

                $this->repository->updateSettingsCountry($user, $country);

            }
            $user->update($request->all());

            return redirect()->back();

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function userPhoto(UserPhotoRequest $request)
    {

        $user = User::find($request->user()->id);

        if (\Input::hasFile('photo')) {
            // upload image
            $image = \Input::file('photo');

            $user->bindLogoImage($image, $user);

            Toastr::info(trans('messages.yourPhotoUpdated'), $title = $user->name, $options = []);

            return redirect()->back();

        } else return $this->redirectError();

    }

    public function banned($username)
    {

        return view('user.banned', compact('username'));
    }

    public function tags($slug)
    {
        if(!Auth::guest()) {
            $user = Auth::user();
            $users = User::withAnyTag([$slug])->paginate(8);
            $countUserPosts = $this->postrepo->countUserPosts();
            $currentTeam = $user->currentTeam;
            $countUserEvents = $this->eventrepo->countUserEvents();

            return view('pages.users', compact('users', 'countUserPosts', 'currentTeam', 'countUserEvents'));
        }
        else {
            Toastr::warning('You are not logged in', $title = 'please try login first');
            return redirect()->to('auth/login');
        }
    }
}
