<?php

namespace itway\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use Itway\Models\OpenSourceIdea;
use Itway\Repositories\OpenSourceIdeaRepository;
use nilsenj\Toastr\Facades\Toastr;

class AdminOpenSourceController extends Controller
{
    private $openrepo;

    public function __construct(OpenSourceIdeaRepository $openrepo)
    {
        $this->openrepo = $openrepo;

    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound($code = null)
    {
        return redirect()->intended(App::getLocale() . '/admin')->with(Toastr::error('Post Not Found!', $title = isset($code) ? $code : 'reply to devs if possible', $options = []));
    }

    /**
     * redirect error
     * @param null $code
     * @return mixed
     */
    protected function redirectError($code = null)
    {
        return redirect()->intended(App::getLocale() . '/admin')->with(Toastr::error("Error appeared!", $title = isset($code) ? $code : 'reply to devs if possible', $options = []));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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
    public function banORunBan($id)
    {
        try {

            $openSource = OpenSourceIdea::find($id);

            if (\Auth::user()->id === $openSource->user->id || !\Auth::user()->hasRole('Admin')) {

                Toastr::error('Can\'t be banned!', $title = $openSource->title, $options = []);

                return redirect()->back();
            } else {

                $this->openrepo->banORunBan($id);
            }
            return redirect()->back();

        } catch (ModelNotFoundException $e) {

            $code = 'erorr_message: ' . $e->getMessage() . ' . ' . 'error_code' . $e->getCode();

            return $this->redirectNotFound($code);
        }
    }
}
