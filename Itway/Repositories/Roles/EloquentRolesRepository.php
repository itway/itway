<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/19/2015
 * Time: 1:10 PM
 */

namespace Itway\Repositories\Roles;

use Itway\Repositories\EloquentRepository;
use itway\Role;
use itway\Permission;

class EloquentRolesRepository extends EloquentRepository implements RolesRepository
{
       public function getModel()
    {
        $model = Role::class;

        return new $model;
    }
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('name', 'like', $search)
            ->orWhere('slug', 'like', $search)
            ->paginate($this->perPage())
            ;
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

    public function update($data, $dataPerm, $role){

        $role->update($data);


        $listIds = $dataPerm["permissions"];

        if ($role->permissions->count()) {

            $role->detachAllPermissions();


            foreach($listIds as $key => $value ) {


                $role->attachPermission(Permission::find($value));

            }
        }
        if ($role->permissions->count() == 0 && count(\Input::get('permissions')) > 0) {


            foreach($listIds as $key => $value ) {

                $role->attachPermission(Permission::find($value));

            }
        }

    }


}