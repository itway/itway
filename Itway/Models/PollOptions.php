<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Itway\Models\Poll;

class PollOptions extends Model implements Transformable
{
    use TransformableTrait;


    protected $table = "pollOptions";

    public $timestamps = false;

    protected $fillable = ["option", "poll_id"];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

}
