<?php

namespace Itway\Repositories;

use Countries;
use Itway\Models\User;
use Itway\Uploader\ImageContract;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Response;

/**
 * Class UserRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    use ImageTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => '=',
        'email' => 'like',
        'bio' => 'like',
        'Google' => 'like',
        'Facebook' => 'like',
        'Twitter' => 'like',
        'Github' => 'like',
        'country_name' => 'like'
    ];


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $instance
     * @param $country
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettingsCountry($instance, $country)
    {

        try {
            $instance->country = strtoupper($country);

            $instance->country_name = $this->getCountriesByValue($country);

            $instance->save();

        } catch (\Exception $e) {

            \Toastr::error('error appeared', 'try once more or contact to admin');

            return redirect()->back();
        }
    }

    /**
     * get the model
     *
     * @return mixed
     */
    public function getModel()
    {
        $model = User::class;

        return new $model;
    }

    /**
     * fetch user's role name
     *
     * @param $user
     * @return mixed
     */
    public function getRole($user)
    {
        foreach ($user->roles()->get() as $role) {
            {
                return [$role->id, $role->name];
            }
        }
    }

    /** fetch all paginated, published and localed users */
    public function getAll()
    {
        return $this->getModel()->paginate();
    }

    /**
     * return the number of today's posts
     * @return mixed
     */
    public function todayUsers()
    {

        return $this->getModel()->groupBy('created_at')->latest('created_at')->today()->paginate();

    }

    /**
     * return the number of today's posts
     * @return mixed
     */
    public function todayUsersCount()
    {

        return $this->getModel()->groupBy('created_at')->latest('created_at')->today()->count();

    }

    /**
     * @param $user
     * @return string
     */
    public function getUserPhoto($user)
    {
        if (!empty($user->getMedia('logo')->first())) {

            $pictures = $user->getMedia('logo');
            $picture = $pictures[0]->getUrl();

            return url($picture);
        } else {

            if (!empty($user->getMedia('images')->first())) {

                $pictures = $user->getMedia('images');
                $picture = $pictures[0]->getUrl();
                return url($picture);

            } else {
                return url('images/' . config('image.missingUserPhoto'));
            }
        }
    }

    /**
     * @param $user
     * @return array|null
     */
    public function getUserTeam($user)
    {
        $teams = [];
        foreach ($user->teams()->get() as $key => $team) {
            if (!is_null($team)) {
                $teams[$key] = $team;
            } else $teams = null;
        }
        return $teams;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function queryUserWithLogo($query)
    {

        if (strlen($query) >= 2) {

            $usersCol = User::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $query . '%')->select('slug', 'name')->get('slug', 'name');
            $users = [];
            foreach ($usersCol as $item => $user) {
                $users[$item] = $user;
                $users[$item]['value'] = $user->slug;
                $users[$item]['name'] = "<img src=" . view('includes.user-image')->with('user', User::findBySlugOrFail($user->slug)) . "/>" . User::findBySlugOrFail($user->slug)->name;
            }
            return Response::json(['success' => 'true', 'results' => $users]);
        } else return Response::json(['success' => 'false']);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function queryUser($query)
    {
        if (strlen($query) >= 2) {
            $usersCol = User::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $query . '%')->select('name', 'slug', 'email', 'locale', 'bio', 'location', 'Google', 'Facebook', 'Github', 'Twitter', 'country', 'country_name')->get('name', 'slug', 'email', 'locale', 'bio', 'location', 'Google', 'Facebook', 'Github', 'Twitter', 'country', 'country_name');
            $users = [];
            foreach ($usersCol as $item => $user) {
                $users[$item] = $user;
                $users[$item]['logo'] = "<img src=" . view('includes.user-image')->with('user', User::findBySlugOrFail($user->slug)) . "/>" . User::findBySlugOrFail($user->slug)->name;
            }
            return Response::json(['success' => 'true', 'results' => $users]);
        } else return Response::json(['success' => 'false']);
    }

    /**
     * @param $query
     * @param array $parameters
     * @return mixed
     */
    public function queryUserWith($query, array $parameters)
    {
        if (strlen($query) >= 2) {
            $selectString = implode(",", $parameters);
            $usersCol = User::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $query . '%')->select('name', $selectString)->get('name', $selectString);
            $users = [];
            foreach ($usersCol as $item => $user) {
                $users[$item] = $user;
            }
            return Response::json(['success' => 'true', 'results' => $users]);
        } else return Response::json(['success' => 'false']);
    }

    /**
     * @param $country
     * @return mixed
     */
    public function getCountriesByValue($country)
    {
        $result = Countries::orderBy('name', 'asc')->where('iso_3166_2', strtoupper($country))->select('name')->first();
        return $result->name;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAllExcept($id)
    {
        return $this->getModel()->where('id', '<>', $id)->get();
    }

    /**
     * ban or unban instance
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function banORunBan($id)
    {
        try {
            $instance = $this->getModel()->find($id);
            if ($instance->banned === false) {
                \Toastr::warning(trans('bans.' . strtolower($this->getModelName())), $title = $instance->title, $options = []);
                $instance->banned = true;
            } else {
                \Toastr::info(trans('unbans.' . strtolower($this->getModelName())), $title = $instance->title, $options = []);
                $instance->banned = false;
            }
            $instance->update();
        } catch (\Exception $e) {
            return response("Error appeared. Maybe model doesn't have banned field" . $e->getMessage(), $e->getCode());
        }
    }
}
