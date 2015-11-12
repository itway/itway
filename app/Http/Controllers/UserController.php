<?php namespace itway\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Input;
use itway\Http\Requests;
use Itway\Repositories\UserRepository;
use Itway\Validation\User\UserPhotoRequest;
use Itway\Validation\User\UserUpdateRequest;
use Itway\Models\Picture;
use Itway\Uploader\ImageUploader;
use Itway\Models\User;
use Toastr;
use App;
use Auth;


class UserController extends Controller {

	private $uploader;
    private $repository;

    public function __construct(ImageUploader $uploader, UserRepository $repository){
        $this->uploader = $uploader;
        $this->repository = $repository;
    }

    /**
     * redirect not found
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectNotFound()
    {
        return redirect()->to(App::getLocale().'/user')->with(Toastr::error('User Not Found!',$title = 'the user might be deleted or banned', $options = []));
    }

    /**
     * redirect error
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectError()
    {
        return redirect()->to(App::getLocale().'/user/'.Auth::id())->with(Toastr::error("Error appeared!", $title = Auth::user()->name, $options = []));
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
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        try{
		$user = User::findBySlugOrId($id);

            if ($user->picture()) {

                $picture = $user->picture()->get() ;

            }
            $notFromProfile = false;

		return view('user.user-profile', compact('user', 'picture', 'notFromProfile'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }
	}
	public function settings($id)
	{
        try{
		$user = User::find($id);
        $tags = $user->tagNames();
		return view('user.user-settings', compact('user','tags'));

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
     * @param $id
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
	public function update($id, UserUpdateRequest $request)
	{
     try{
		$user = User::findBySlugOrId($id);

         $taglist = $request->input('tags_list');

         if(! empty($taglist)){

             $user->retag($taglist);
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
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public function userPhoto( UserPhotoRequest $request) {

        $user = User::find($request->user()->id);

        if (\Input::hasFile('photo')) {
            // upload image
            $image = \Input::file('photo');

            $this->repository->bindImage($image, $user);

            Toastr::info(trans('messages.yourPhotoUpdated'), $title = $user->name, $options = []);

            return redirect()->back();
        }
        else return $this->redirectError();

    }

    public function tags($slug) {

        $users = User::withAnyTag([$slug])->paginate(8);

        return view('pages.users', compact('users'));

    }
}
