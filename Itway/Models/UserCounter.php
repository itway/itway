<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class UserCounter extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'user_counter';
    protected $fillable = array('class_name', 'object_id', 'user_id', 'action');

}
