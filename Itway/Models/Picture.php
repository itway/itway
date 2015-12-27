<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class Picture extends Model implements Transformable
{
    use TransformableTrait;
    /**\
     * @var array
     */

    protected $fillable = array('path','banned');


    /**
     * Get all of the owning imageable models.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

//    public function post()
//    {
//        return $this->belongsToMany(Post::class);
//    }
//
//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany]
//     */
//    public function quiz()
//    {
//        return $this->belongsToMany(Quiz::class);
//    }
//
//    public function event()
//    {
//        return $this->belongsToMany(Event::class);
//    }
//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
//     */
//    public function user()
//    {
//        return $this->belongsToMany(User::class);
//    }

}
