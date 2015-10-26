<?php

namespace itway;

use Illuminate\Database\Eloquent\Model;

class QuizUserAnswer extends Model
{
    protected $table = "quiz_user_answer";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quizOptions(){
        return $this->belongsTo(QuizOptions::class);
    }
}
