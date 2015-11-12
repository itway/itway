<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\UserRepository;
use Itway\Models\User;
use Itway\Models\Picture;

/**
 * Class UserRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
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
            ];


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
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

    /**
     * ban or unban the user
     *
     * @param $id
     */
    public function banORunBan($id)
    {
        $user = $this->find($id);

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

    public function bindImage($image, User $user){


        $this->uploader->upload($image, config('image.usersDESTINATION'))->save(config('image.usersDESTINATION'));

        if ($user->picture()->count() !== 0) {

            $picture = $user->picture()->get() ;

            foreach($picture as $pic) {

                User::deleteImage($pic->path);
            }
            $user->picture()->delete();
        }

        $picture = Picture::create(['path' => $this->uploader->getFilename()]);

        $user->picture()->save($picture);

    }

    public function getAllExcept($id)
    {
        return $this->getModel()->where('id', '<>', $id)->get();
    }
}
