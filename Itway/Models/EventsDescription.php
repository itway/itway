<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventsDescription extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    public $timestamps = false;

    protected $table = "events_description";

    protected $fillable = ['description'];

    protected $hidden = ['id', 'events_id'];

    public function event() {

        return $this->belongsTo(\Itway\Models\Event::class);

    }


}
