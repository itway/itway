<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Counter extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'counter';
    protected $fillable = array('class_name', 'object_id');
}
