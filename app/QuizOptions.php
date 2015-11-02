<?php

namespace itway;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizOptions extends Model
{
    protected $table = "quizoptions";

    public $timestamps = false;

    protected $fillable = ["option", "quiz_id"];

    public function quiz()
    {
    return $this->belongsTo(Quiz::class);
    }

}
