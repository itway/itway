<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostBody extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    public $timestamps = false;

    protected $table = "post_body";

    protected $fillable = ['body'];

    protected $hidden = ['id', 'post_id'];

    public function post() {

        return $this->belongsTo(\Itway\Models\Post::class);

    }

}
