<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/18/2015
 * Time: 10:27 AM
 */

namespace Itway\Repositories\Categories;

use itway\Category;
use Itway\Repositories\EloquentRepository;

class EloquentCategoryRepository extends EloquentRepository implements CategoryRepository
{


    public function getModel()
    {
        $model = Category::class;

        return new $model;
    }

}