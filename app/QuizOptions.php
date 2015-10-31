<?php

namespace itway;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizOptions extends Model
{
    use SoftDeletes;

    protected $table = "quizoptions";

    protected $fillable = ["option"];

    public function quiz()
    {
    return $this->belongsTo(Quiz::class);
    }

}
