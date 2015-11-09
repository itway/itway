<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Event extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}
