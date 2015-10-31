<?php

namespace itway;

use Illuminate\Database\Eloquent\Model;

class QuizOptions extends Model
{
    protected $table = "quizoptions";

    protected $fillable = ["option"];

    public function quiz()
    {
    return $this->belongsTo(Quiz::class);
    }

}
