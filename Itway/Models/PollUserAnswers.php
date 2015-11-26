<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class PollUserAnswers extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "poll_user_answers";
    public $timestamps = false;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){

        return $this->hasMany(User::class, 'poll_user_answer','user_id', 'id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pollOptions(){

        return $this->belongsTo(PollOptions::class, 'poll_user_answer','poll_id', 'id');

    }
}
