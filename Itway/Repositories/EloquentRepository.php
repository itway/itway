<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/7/2015
 * Time: 10:50 AM
 */

namespace Itway\Repositories;

abstract class EloquentRepository implements Repository
{

    /**
     * @return int
     */
    public function perPage()
    {
        return 10;
    }

    /**
     * @param null $searchQuery
     * @return mixed
     */

    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }
        return $this->search($searchQuery);
    }

    /**
     * @param null $searchQuery
     * @return mixed
     */
    public function allOrSearchUsers($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAllUsers();
        }
        return $this->search($searchQuery);
    }

    /**
     * getALl instances
     *
     * @return mixed
     *
     */
    public function getAll()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->paginate($this->perPage());
    }

    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('title', 'like', $search)
            ->orWhere('body', 'like', $search)
            ->orWhere('id', '=', $searchQuery)
            ->paginate($this->perPage())
            ;
    }

    /**
     * return all user's instances as collection
     *
     * @return mixed
     */
    public function getAllUsers()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->users()->paginate($this->perPage());
    }
    /**
     * find the instance by id
     *
     * @param int $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->getModel()->find($id);
    }

    /**
     * find the instance by something
     *
     * @param string $key
     * @param string $value
     * @param string $operator
     * @return mixed
     */
    public function findBy($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }

    /**
     *  delete the instance
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function delete($id)
    {
        $instance = $this->findById($id);
        if (!is_null($instance)) {
            $instance->delete();
            return true;
        }
        return false;
    }

    /**
     * simple creation not implemented anywhere
     * but should exist here because of the main repository interface
     *
     * @param array $data
     * @return mixed4
     */
    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

}