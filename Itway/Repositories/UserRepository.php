<?php

namespace Itway\Repositories;

use Itway\Models\User;
use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace Itway\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function getRole($user);
    public function getUserPhoto($user);
    public function getAllExcept($id);
    public function getAll();
    public function updateSettingsCountry($instance, $country);
    public function getUserTeam($user);
    public function banORunBan($id);

}
