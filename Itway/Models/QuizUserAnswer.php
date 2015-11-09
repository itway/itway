<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class QuizUserAnswer extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "quiz_user_answer";
    public $timestamps = false;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){

        return $this->hasMany(User::class, 'quiz_user_answer','user_id', 'id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quizOptions(){

        return $this->belongsTo(QuizOptions::class, 'quiz_user_answer','quiz_id', 'id');

    }
}
