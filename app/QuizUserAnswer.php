<?php

namespace itway;

use Illuminate\Database\Eloquent\Model;

class QuizUserAnswer extends Model
{
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
