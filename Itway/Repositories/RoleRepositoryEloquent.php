<?php

namespace Itway\Repositories;

use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use Itway\Repositories\RoleRepository;
use Itway\Models\Role;
use Itway\Models\Permission;

/**
 * Class RoleRepositoryEloquent
 * @package namespace Itway\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getModel()
    {
        $model = Role::class;

        return new $model;
    }

    public function create(array $data)
    {
        $listIds = $data['permissions'];

        $roleCreate = $this->getModel()->create($data);


        foreach($listIds as $key => $value ) {


            $roleCreate->attachPermission($value);

        }
        return $roleCreate;
    }

    public function updateRole($data, $dataPerm, $role)
    {

        $role->update($data);


        $listIds = $dataPerm["permissions"];

        if ($role->permissions->count()) {

            $role->detachAllPermissions();


            foreach ($listIds as $key => $value) {


                $role->attachPermission(Permission::find($value));

            }
        }
        if ($role->permissions->count() == 0 && count(\Input::get('permissions')) > 0) {


            foreach ($listIds as $key => $value) {

                $role->attachPermission(Permission::find($value));

            }
        }
    }

    }
