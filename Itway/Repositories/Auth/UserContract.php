<?php namespace Itway\Repositories\Auth;

/**
 * Interface UserContract
 * @package App\Repositories\User
 */
interface UserContract {



    public function create($data);

    /**
     * @param $data
     * @param $provider
     * @return mixed
     */
    public function findByUserNameOrCreate($data, $provider);

    /**
     * @param $data
     * @param $user
     * @param $provider
     * @return mixed
     */
    public function checkIfUserNeedsUpdating($data, $user, $provider);
}