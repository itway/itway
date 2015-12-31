<?php

namespace itway\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use Itway\Models\Role;
use Itway\Models\User;
use Itway\Repositories\PostRepository;
use Itway\Repositories\UserRepository;
use Itway\Validation\User\UsersFormRequest;
use Itway\Validation\User\UsersUpdateFormRequest;
use nilsenj\Toastr\Facades\Toastr;

/**
 * Class AdminUsersController
 * @package itway\Http\Controllers\Admin
 */
class AdminUsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var PostRepository
     */
    private $postrepo;

    /**
     * AdminUsersController constructor.
     * @param UserRepository $repository
     * @param PostRepository $postrepo
     */
    public function __construct(UserRepository $repository, PostRepository $postrepo)
    {
        $this->repository = $repository;
        $this->postrepo = $postrepo;

    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect()->to(\App::getLocale().'/admin/users');
    }
    /**
     * Display a listing of users
     *
     * @return Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('RepositoryLab\Repository\Criteria\RequestCriteria'));

        $users = $this->repository->paginate();
        $no = $users->firstItem();
        $countUserPosts = $this->postrepo->countUserPosts();
        return view('admin.users.index', compact('users', 'no', 'countUserPosts'));
    }

    /**
     * create user page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all()->lists('name', 'id');
        $countUserPosts = $this->postrepo->countUserPosts();
        return view('admin.users.create', compact('roles', 'countUserPosts'));
    }

    /**
     * store created user
     *
     * @param UsersFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UsersFormRequest $request)
    {
        $data = $request->all();

        $user = $this->repository->create($data);

        $user->attachRole($request->get('role'));

        return redirect()->to(\App::getLocale().'/admin/users');
    }

    /**
     * show the user
     *
     * @param $slug
     * @return \Illuminate\View\View|Response
     */
    public function show($slug)
    {
        try {
            $user = User::findBySlug($slug);

            $role = $this->repository->getRole($user);
            $countUserPosts = $this->postrepo->countUserPosts();

            return view('admin.users.show', compact('user', 'role', 'countUserPosts'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }
    }

    /**
     * edit page for users
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function edit($id)
    {
        try {
            $user = User::find($id);

            $roles = Role::all()->lists('name', 'id');

            $role = $this->repository->getRole($user);

            return view('admin.users.edit', compact('user', 'roles', 'role'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }
    }

    /**
     * update users data
     *
     * @param UsersUpdateFormRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function update(UsersUpdateFormRequest $request, $id)
    {
        try {
            $data = ! $request->has('password') ? $request->except('password') : $request->all();

            $user = User::find($id);

            $user->update($data);

            $user->roles()->sync((array) \Input::get('role'));

            return redirect()->back();

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();

        }
    }

    /**
     *  delete user
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function destroy($id)
    {
        try {
            $username = User::find($id)->name;

            if(''.\Auth::user()->id === $id) {

                Toastr::error('Can\'t be deleted!', $title = $username, $options = []);

                return redirect()->back();
            }
            else {
                Toastr::success('User deleted!', $title = $username, $options = []);

                $this->repository->delete($id);
            }
            return redirect()->back();

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function banORunBan($id) {
        try {
            $username = User::find($id)->name;

            if(''.\Auth::user()->id === $id) {

                Toastr::error('Can\'t be banned!', $title = $username, $options = []);

                return redirect()->back();
            }
            else {

                $this->repository->banORunBan($id);
            }
            return redirect()->back();

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }
    }
}
