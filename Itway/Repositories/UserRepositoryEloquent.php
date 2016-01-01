<?php

namespace Itway\Repositories;

use Countries;
use Itway\Models\User;
use Itway\Uploader\ImageContract;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use RepositoryLab\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository, ImageContract
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
     * @param $user
     * @return string
     */
    public function getUserPhoto($user)
    {
        if (!empty($user->picture()->get()->all())) {

            $picture = $user->picture()->get()->first()->path;

            return url(config('image.usersDESTINATION') . $picture);
        } else {

            if ($user->photo) {

                return $user->photo;

            } else {

                return url('images/' . config('image.missingUserPhoto'));

            }
        }

    }

    public function getUserTeam($user)
    {
        $teams = [];
        foreach ($user->teams()->get() as $key => $team) {
            if(!is_null($team)) {
                $teams[$key] = $team;
            }
            else $teams = null;
        }
        return $teams;
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
            $instance = $this->find($id);
            if ($instance->banned === 0) {
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
