<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository
 * @package namespace Itway\Repositories;
 */
interface RoleRepository extends RepositoryInterface
{
    public function updateRole($data, $dataPerm, $role);

}
