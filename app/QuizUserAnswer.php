<?php

namespace itway;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizUserAnswer extends Model
{
    use SoftDeletes;

    protected $table = "quiz_user_answer";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){

        return $this->hasMany(User::class);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quizOptions(){

        return $this->belongsTo(QuizOptions::class);

    }
}
