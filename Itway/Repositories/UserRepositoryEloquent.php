<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\UserRepository;
use Itway\Models\User;
use Itway\Models\Picture;
use Itway\Uploader\ImageTrait;
use Itway\Uploader\ImageContract;

use Itway\Contracts\Bannable\Bannable;
use Itway\Traits\Banable;
use Countries;

/**
 * Class UserRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository, ImageContract, Bannable
{
    use ImageTrait, Banable;
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

    public function updateSettingsCountry($instance, $country) {

        try {
            $instance->country = strtoupper($country);

            $instance->country_name = $this->getCountriesByValue($country);

            $instance->save();

        } catch (\Exception $e){

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
    public function getRole($user) {

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
        if(!empty($user->picture()->get()->all())) {

            $picture = $user->picture()->get()->first()->path;

            return  url(config('image.usersDESTINATION'). $picture);
        }
        else {

            if ($user->photo) {

                return $user->photo;

            } else {

                return url('images/'.config('image.missingUserPhoto'));

            }
        }

    }

    public function getUserTeam($user) {
        $teams = [];
        foreach ($user->teams()->get() as $key => $team) {
            $teams[$key] = $team;
        }
        return $team;
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
}
