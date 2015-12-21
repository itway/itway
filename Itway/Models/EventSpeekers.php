<?php

namespace Itway\Models;

use Illuminate\Database\Eloquent\Model;
use RepositoryLab\Repository\Contracts\Transformable;
use RepositoryLab\Repository\Traits\TransformableTrait;
use Itway\Models\Event;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Itway\Contracts\Likeable\Likeable;
use Itway\Traits\Likeable as LikeableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Itway\Models\Picture;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Cookie;

class EventSpeekers extends Model implements Transformable, SluggableInterface, Likeable
{
    use TransformableTrait;
    use SluggableTrait, SoftDeletes;
    use \Conner\Tagging\TaggableTrait;
    use \Itway\Traits\ViewCounterTrait;
    use LikeableTrait;


    protected $fillable = [
        'events_id',
        'user_id',
        'name',
        'description',
        'slug',
        'speeker_logo',
        'speeker_link',
        'speeker_company',
        'speeker_skills'];

    protected $table = "event_speekers";
    /**
     * @var array
     */
    protected $sluggable = array(
        'build_from' => 'title',
        'save_to' => 'slug'
    );
    public function event()
    {
        $this->belongsTo(Event::class, 'events_id', 'id');
    }

    public function fromSiteSpeekers()
    {
        if (!is_null($this->user_id)) {
            $users = User::findBySlugOrIdOrFail($this->user_id);
            return $users;
        } else return null;
    }

    public function isFromSite()
    {
        if (!is_null($this->user_id)) {
            return true;
        } else return false;
    }
}
