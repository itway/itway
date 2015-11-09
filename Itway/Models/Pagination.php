<?php

namespace Itway\Models;
use Landish\Pagination\ZurbFoundation;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Pagination extends ZurbFoundation implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}
