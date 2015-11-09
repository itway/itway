<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;

class QuizOptions extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "quizoptions";

    public $timestamps = false;

    protected $fillable = ["option", "quiz_id"];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
