<?php

namespace itway;

use Illuminate\Database\Eloquent\Model;

class QuizOptions extends Model
{
    protected $table = "quizOptions";
    protected $fillable = ["option"];

    public function quiz()
    {

    return $this->belongsTo(Quiz::class);

    }

}
