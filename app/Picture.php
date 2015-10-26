<?php

namespace itway;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    /**\
     * @var array
     */

    protected $fillable = array('path');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function post()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

}
