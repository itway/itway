<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/22/2015
 * Time: 11:20 PM
 */

namespace Itway\Repositories\Users;

use Itway\Repositories\EloquentRepository;
use itway\User;

class EloquentUserRepository extends EloquentRepository implements UserRepository
{


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
     * simple search for the users
     *
     * @param mixed $searchQuery
     * @return mixed
     */
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('name', 'like', $search)
            ->orWhere('Email', 'like', $search)
            ->orWhere('id', '=', $searchQuery)
            ->paginate($this->perPage())
            ;
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

    /**
     * ban or unban the user
     *
     * @param $id
     */
    public function banORunBan($id)
    {
        $user = $this->findById($id);

        if ($user->banned === 0) {

            \Toastr::warning('User banned!', $title = $user->name, $options = []);

            $user->banned = true;

        }
        else {
            \Toastr::info('User unbanned!', $title = $user->name, $options = []);

            $user->banned = false;
        }

        $user->update();
    }

    public function getUserPhoto($user)
    {
        if(!empty($user->picture()->get()->all())) {

            $picture = $user->picture()->get()->first()->path;

            return  url('images/users/' . $picture);
        }
        else {

            if ($user->photo) {

                return $user->photo;

            } else {

                return url('dist/images/50-50.jpg');

            }
        }

    }
    public function getAllExcept($id)
    {
        return $this->getModel()->where('id', '<>', $id)->get();
    }


}