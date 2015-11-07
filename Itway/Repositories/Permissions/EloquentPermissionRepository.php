<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/21/2015
 * Time: 4:15 PM
 */

namespace Itway\Repositories\Permissions;

use itway\Permission;
use Illuminate\Encryption\Encrypter;
use Itway\Repositories\EloquentRepository;

class EloquentPermissionRepository extends EloquentRepository implements PermissionRepository{


    public function getModel()
    {
        $model = Permission::class;

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
    public function update($data, $permission) {

        $permission->update($data);

    }

}