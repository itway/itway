<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Itway\Modls\Event;
use Itway\Models\User;

class EventUsers extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "event_users";
    protected $fillable = ['events_id', 'user_id'];

     public function event()
    {
        
        return $this->belongsToMany(Event::class, "events_id", "id");
    
    }

    public function users() {

    	$this->belongsTo(User::class, "user_id", "id");
    }


}
