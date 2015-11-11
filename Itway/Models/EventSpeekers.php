<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Itway\Models\Event;

class EventSpeekers extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['events_id',
            'name',
            'description',
            'slug',
            'speeker_logo',
            'speeker_link',
            'speeker_company',
            'speeker_skills',
            'published_at'];

    protected $table = "event_speekers";

    public function event() {

    	$this->belongsTo(Event::class);
    
    }

}
