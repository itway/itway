<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
class Chat extends Model implements Transformable, HasMedia
{
	
    use TransformableTrait;
    use HasMediaTrait;

    protected $fillable = [];

    public function picture()
    {
        return $this->morphMany(\Itway\Models\Picture::class, 'imageable');
    }
}
