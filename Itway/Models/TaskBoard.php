<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use Itway\Uploader\ImageTrait;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class TaskBoard extends Model implements Transformable, HasMedia
{
    use HasMediaTrait;
    use TransformableTrait;
    use ImageTrait;

    protected $fillable = [];

}
