<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface PermissionRepository
 * @package namespace Itway\Repositories;
 */
interface PermissionRepository extends RepositoryInterface
{
    public function updatePermission($data, $permission);

}
